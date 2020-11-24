<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

    // set_timezopne
    // set_defau
    
    public function __construct(){
        parent::__construct();
    }
    
    public function register(){
		$this->load->model('MailSender');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('first_name', 'FIrst Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]', array('is_unique'=>'This %s already exist'));
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
		//$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['status'=>0, 'msg'=>str_replace(['<p>', '</p>'], ['',''], validation_errors())]);
        } else {
            // $ref = 
            $newuser = $this->input->post();
            $userinfo = $this->db->get_where('users', ['email'=>$newuser['email']])->row();
            if ($userinfo) {
                echo json_encode(['status'=>0, 'msg'=>'Account with the provided credentials already exists']);
            } else {
                if (!isset($newuser['cooperative_id']) || $newuser['cooperative_id'] == null || $newuser['cooperative_id'] == '') {
                    echo json_encode(['status' => 0, 'msg' => "Please select your organization or select 'My organization is not Here' if not listed", 'redirect' => 'noreload']);
                    exit();
                }
                if ($newuser['referred_by'] != '' && $this->db->get_where('users', ['refferral_code' => $newuser['referred_by']])->row() != null) {
                    echo json_encode(['status' => 0, 'msg' => 'User with the provided referral code do not exist! Get the correct referral code or leave the field blank', 'redirect' => 'noreload']);
                    // exit();
                } else {
                    $newuser['user_id'] = "PSSUSER".random_string('nozero', 5);
                    $newuser['refferral_code'] = "PSSREFCODE".random_string('nozero', 5);
                    
                    if ($newuser['cooperative_id'] == 'no_cooperative') {
                        $upload1 = $this->upload_file('id_card', './public/images/id_cards/', $newuser['user_id']);
                        $upload2 = $this->upload_file('bank_statement', './public/images/bank_statements/', $newuser['user_id']);
                        if ($upload1['status'] == 0) {
                            echo json_encode(['status' => 0, 'msg' => $upload1['error'], 'redirect' => 'noreload']);
                            exit();
                        }
                        if ($upload2['status'] == 0) {
                            echo json_encode(['status' => 0, 'msg' => $upload2['error'], 'redirect' => 'noreload']);
                            exit();
                        }
                        $newuser['bank_statement_path'] = ('/public/images/bank_statements/'.str_replace(' ', '-', $upload2['upload_data']['file_name']));
                        $newuser['id_card_path'] = ('/public/images/id_cards/'.str_replace(' ', '-', $upload1['upload_data']['file_name']));
                    }
                    $newuser['full_name'] = $this->input->post('first_name').' '.$this->input->post('last_name');
                    unset($newuser['first_name']);
                    unset($newuser['last_name']);
                    $newuser['token'] = random_string('alnum', 32);
                    $newuser['active'] = 0;
                    // echo json_encode($newuser); exit();
                    $newuser['image'] = site_url('/public/images/users/p.png');
                    $newuser['password'] = password_hash($newuser['password'], PASSWORD_DEFAULT);
                    $newuser['created_at'] = date('Y-m-d H:i:s a');
    
                    $msg = array();
                    $rUrl = '';
                    if ($newuser['cooperative_id'] == 'no_cooperative') {
                        $newuser['step'] = 2;
                    } else {
                        $this->db->insert('cooperative_member', ['member_id' => $newuser['user_id'], 'cooperative_id' => $newuser['cooperative_id'], 'approved' => 0]);
                        $newuser['step'] = 1;
                    }
                    // $message = $this->load->view('mail_templates/reg_temp', $data, true);
                    if ($this->db->insert('users', $newuser) && $this->db->insert('contacts', ['user_id' => $newuser['user_id'], 'email' => $newuser['email']])) {
                        if ($newuser['cooperative_id'] == 'no_cooperative') {
                            // $admins = $this->db->get_where('admins', ['acct_type' => 'admin'])->result();
                        
                            $msg['subject'] = "Confirm Your Account";
                            $msg['message'] = "<p>You just registered on Paysmosmo with the information below<br/> Name: ".$newuser['full_name']." <br/> Email: ".$newuser['email']."</p>";
                            $msg['message'] .= "<a href='".site_url('account/verify/'.$newuser['token'])."'>Click here</a> to confirm";
                            $mailSent = false;
                            // foreach ($admins as $key => $admin) {
                            //     $to['name'] = $admin->email;
                            // 	$to['email'] = $admin->email;
                            // 	array_push($tos, $to);
                            // }
                            $to['name'] = $newuser['full_name'];
                            $to['email'] = $newuser['email'];
                            if ($this->MailSender->send_mail($to, $msg, 'html')) {
                                $mailSent = true;
                            }
                            if ($mailSent) {
                                $rUrl = site_url('buyer/login');
                                echo json_encode(['status'=>1, 'msg'=>'Registration Successful! An email have been sent to your mail. proceed to your mail to complete registration', 'redirect'=>$rUrl]);
                            } else {
                                $this->db->where(['user_id' => $newuser['user_id']])->delete('users');
                                echo json_encode(['status'=>0, 'msg'=>'An error occurred please try again Later in an hour']);
                            }
                        } else {
                            $cooperativeData = $this->db->get_where('cooperatives', ['cooperative_id' => $newuser['cooperative_id']])->row();
                            $to['name'] = $cooperativeData->name;
                            $to['email'] = $cooperativeData->email;
                            $msg['subject'] = "New Member Confirmation";
                            $msg['message'] = "<p>A new user id: ".$newuser['user_id']." name: ".$newuser['full_name']." and email: ".$newuser['email']." on Paysmosmo have registered as you member. You are required to confirm the user as your member.</p>";
                            $msg['message'] .= "<a href='".site_url('cooperative/members/members_list')."'>Click here</a> to confirm";
                            if ($this->MailSender->send_mail($to, $msg, 'html')) {
                                $rUrl = site_url('buyer/login');
                                echo json_encode(['status'=>1, 'msg'=>'Registration Successful! Your account is awaiting approval from your cooperative admin', 'redirect'=>$rUrl]);
                            } else {
                                $this->db->where(['user_id' => $newuser['user_id']])->delete('users');
                                $this->db->where(['member_id' => $newuser['user_id']])->delete('cooperative_member');
                                echo json_encode(['status'=>0, 'msg'=>'An error occurred please try again Later in an hour']);
                            }
                        }
                    } else {
                        if ($this->db->where(['user_id' => $newuser['user_id']])->delete('users') && $this->db->where(['member_id' => $newuser['user_id']])->delete('cooperative_member')) {
                            echo json_encode(['status'=>0, 'msg'=>'An error occurred please try again Later in an hour']);
                               exit();
                        }
                    }
                }
                // echo json_encode($newuser);
            }
        }
        // echo json_encode($newuser);
    }

    public function login() {
        $email = $this->input->post('email', TRUE);
        $pass = $this->input->post('password', TRUE);
        $acct_type = $this->input->post('acct_type', TRUE);
		$logInInfo = $this->db->get_where('admins', ['email'=>$email, 'acct_type' => 'admin'])->row();
		
        if ($logInInfo && password_verify($pass, $logInInfo->password)) {
			$userData = $this->db->get_where('users', ['user_id' => $logInInfo->user_id])->row();
            if ($userData->step == 1) {
                echo json_encode(['status' => 0, 'msg' => 'Your account is awaiting your cooperative admin approval', 'redirect' => 'noreload']);
            }
            if ($userData->step == 2) {
                echo json_encode(['status' => 0, 'msg' => 'Your account is awaiting final approval from the Admin', 'redirect' => 'noreload']);
            }
            if ($userData->step == 3) {
                echo json_encode(['status' => 0, 'msg' => 'Your account is suspended', 'redirect' => 'noreload']);
            }
            if ($userData->step == 4) {
                echo json_encode(['status' => 0, 'msg' => 'Your account is suspended by your cooperative admin', 'redirect' => 'noreload']);
            }
            if ($userData->step == 0) {
                $this->session->set_userdata('user', $userData);
                $this->session->userdata('user')->loggedinas = $logInInfo->acct_type;
                $url = ($this->session->tempdata('rfrom')) ? $this->session->tempdata('rfrom') : site_url('/'.$this->session->userdata('user')->loggedinas.'/index');
                if($this->session->tempdata('rfrom')){
                    $this->session->unset_tempdata('rfrom');
                }
                echo json_encode(['status'=>1, 'msg'=>'Login Successful', 'redirect'=>$url]);
            }
        }else{
            echo json_encode(['status'=>0, 'msg'=>'Login Credentials is Invalid. Please Check your email and password']);
        }
    }

    public function switchto($to = 'buyer'){
        if($this->session->userdata('user') && $this->hasAcctType($to, $this->session->userdata('user'))){
            $this->session->userdata('user')->loggedinas = $to;
            redirect(site_url('/'.$to.'/home'));
        }
    }

    public function addtoaccounttype($acct_type = 'buyer'){
        if($this->session->userdata('user')){
            $userdata = $this->session->userdata('user');
            if(!$this->hasAcctType($acct_type, $this->session->userdata('user'))){
                $userinfo = $this->UserModel->getUserBy('user_id', $userdata->user_id);
                // if($this->db->)
                $userinfo['acct_type'] = $userinfo['acct_type'].',seller';
                if($this->db->where('user_id', $userinfo['user_id'])->update('users', $userinfo) && $this->db->insert('sellers', ['seller_id'=>$userinfo['user_id']])){
                    $this->session->userdata('user')->acct_type .= ',seller';
                    echo json_encode(['status'=>1, 'msg'=>'You are now a/an '.$acct_type, 'redirect'=>'reload']);
                    // echo ;
                }else{
                    echo json_encode(['status'=>0, 'msg'=>'Unable to register you as a/an '.$acct_type, 'redirect'=>'reload']);
                    // echo ;
                }
            }else{
                echo json_encode(['status'=>0, 'msg'=>'You are a/an '.ucfirst($acct_type).' already']);
                // echo ;
                // $this->session->userdata('user')->loggedinas = $to;
                // redirect(site_url('/'.$to.'/home'));
            }
            
        }
    }

    public function send_mail($mail_to, $subject, $msg, $mailtype="html") {
        //Load email library
        $this->load->library('email');

        $config = array();
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
        $config['smtp_user'] = $this->config->item('smtp_user');
        $config['smtp_pass'] = $this->config->item('smtp_pass');
        $config['smtp_port'] = 465  ;
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = $mailtype;
        $this->email->initialize($config);

        $this->email->set_newline("\r\n");
        $this->email->from($this->config->item('smtp_user'), 'White Market');
        $this->email->to($mail_to);
        $this->email->subject($subject);
        $this->email->message($msg);
        //Send mail
        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    public function hasAcctType($type, $user){
        $useracct = explode(',', $user->acct_type);
        if(in_array($type, $useracct)){
            return true;
        }else{
            return false;
        }
    }

    public function request_password_reset() {
        $email = $this->input->post('email');
        $userData = $this->db->get_where('users', ['email' => $email])->row();
        if ($userData) {
            $token = random_string('alnum', 32);
            if ($this->db->where(['user_id' => $userData->user_id])->update('users',['token' => $token])) {
                $this->load->model('MailSender');
                $to['email'] = $userData->email;
                $to['name'] = $userData->full_name;
                $msg['subject'] = 'Password Reset Request';
                $msg['message'] = '<h1>Password Reset Request</h1>';
                $msg['message'] .= '<p>You requested to change your password. Click the link below to proceed to password reset page!</p>';
                $msg['message'] .= '<p>Note: If you do not know about this request, ignore this email else proceed.</p>';
                $msg['message'] .= '<a href="'.site_url('account/reset/'.$token).'">Click Here</a> to reset your password';
                if ($this->MailSender->send_mail($to, $msg, 'html')) {
                    echo json_encode(['status' => 1, 'msg' => 'You will receive an email for the next step to take, if you have an account with us', 'redirect' => 'reload']);
                } else {
                    echo json_encode(['status' => 0, 'msg' => 'Unable to place you request', 'redirect' => 'reload']);
                }
            } else {
                echo json_encode(['status' => 0, 'msg' => 'Unable to place you request', 'redirect' => 'reload']);
            }
        } else {
            echo json_encode(['status' => 0, 'msg' => 'You email address doesn\'t match any of our record', 'redirect' => 'noreload']);
        }
    }

    public function reset($token = null) {
        if ($token == null && !$this->input->post()) {
            $this->session->set_flashdata('msg', 'Token is required for this operation!');
            $this->session->set_flashdata('flag', 'error');
            redirect(site_url());
        } else if ($token != null && !$this->input->post()) {
            $userData = $this->db->get_where('users', ['token' => $token])->row();
            if ($userData) {
                $data['user_id'] = $userData->user_id;
                $data['scripts'] = ['main.js', 'forms.js'];
                $data['page_title'] = ' Buyer | Login';
                $this->load->view('layouts/general/head.php', $data);
                $this->load->view('buyer/reset-password', $data);
                $this->load->view('layouts/general/foot.php', $data);
            } else {
                $this->session->set_flashdata('msg', 'Invalid Token! Request for another.');
                $this->session->set_flashdata('flag', 'error');
                redirect(site_url());
            }
        } else if ($token == null && $this->input->post()) {
            $newPassword = $this->input->post('new_password');
            $confirmPassword = $this->input->post('confirm_password');
            $user_id = hex2bin($this->input->post('user_id'));
            if ($newPassword != $confirmPassword) {
                echo json_encode(['status' => 0, 'msg' => 'Password Do Not Match', 'redirect' => 'noreload']);
            } else {
                $user['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
                $user['token'] = '';
                $user['active'] = 1;
                $user['step'] = 0;
                if ($this->db->where(['user_id' => $user_id])->update('users', $user)) {
                    echo json_encode(['status' => 1, 'msg' => 'Password Changed Successfully!', 'redirect' => site_url('buyer/login')]);
                } else {
                    echo json_encode(['status' => 0, 'msg' => 'Unable to reset your password! Please try again later', 'redirect' => 'noreload']);
                }
            }
        }
    }

    public function verify($token){
        $this->load->model('MailSender');
        $checkifverified = $this->db->get_where('users', array('token'=>$token, 'active'=>0))->row();

        if ($checkifverified) :
            $email = $checkifverified->email;
            $name = $checkifverified->full_name;
            $acct_type = ($checkifverified->acct_type) ? $checkifverified->acct_type : 'buyer';
            $verify = $this->db->where(['token' => $token])->update('users', ['active' => 1, 'step' => 0]);
            if($verify){
                $this->session->set_flashdata('msg', 'Account Verified Successfully!');
                $this->session->set_flashdata('flag', 'success');
                $checkifverified->step = 0;
                $checkifverified->active = 1;
                // $checkifverified->loggedinas = 'buyer';
                // $this->session->set_userdata('user', $checkifverified);
                $msg['subject'] = 'Account verification!';
                $msg['message'] = '<p>Account verification successful!</p>';
                $to['name'] = $name;
                $to['email'] = $email;
                if($this->MailSender->send_mail($to, $msg, 'html')) {
                    // $status = array('status'=>1, 'msg'=>'Account Verified Successfully', 'url'=>site_url('/'.$loginas.'/login'));
                    redirect(site_url('buyer/login'));
                    // echo json_encode($status);
                } else {
                    $this->db->where(['token' => $token])->update('users', ['active' => 0, 'step' => 1]);
                    $this->session->set_flashdata('msg', 'Account Not Verified! Please try again later');
                    $this->session->set_flashdata('flag', 'danger');
                    redirect(site_url('buyer/login'));
                }
            } else {
                $this->session->set_flashdata('msg', 'Account Not Verified! Please try again later');
                $this->session->set_flashdata('flag', 'danger');
                redirect(site_url('buyer/login'));
            }
        else:
            $this->session->set_flashdata('msg', 'Account already verified! Please login');
            $this->session->set_flashdata('flag', 'info');
            redirect(site_url('buyer/login'));
        endif;

    
    }

    public function logout(){
        $this->session->unset_userdata('user');
        redirect(site_url());
    }

    public function upload_file($key = 'userfile', $saveTo = '', $saveWith = '') {
        $config['upload_path'] = $saveTo;
        $config['file_name'] = $saveWith;
        $config['allowed_types'] = '*';

        if ($this->load->is_loaded('upload')) {
            unset($this->upload);
            $this->load->library('upload', $config);
        } else {
            $this->load->library('upload', $config);
        }

        if ( ! $this->upload->do_upload($key))
        {
                return array('status' => 0, 'error' => str_replace(['<p>', '</p>'], [''], $this->upload->display_errors()));

        }
        else
        {
                return array('status' => 1, 'upload_data' => $this->upload->data());

        }
    }



//     public function recover(){
//         $this->form_validation->set_rules('email', "Email", 'required|valid_email');
//         if($this->form_validation->run() === false){
//             echo json_encode([
//                 'status'=>0,
//                 'msg'=>validation_errors(),
//             ]);
//         }else{
//             $email = $this->input->post('email');
//             $check = $this->db->get_where('users', ['email'=>$email])->row();
//             if($check){
//                 $data['userdata'] = $check;

//                 $message = $this->load->view('mail_templates/password_recovery', $data, true);

//                 if($this->send_mail($email, 'Password Recovery', $message)){
//                     echo json_encode([
//                         'status'=>1,
//                         'msg'=>"A Recovery Email Have Beem Sent To Your Email",
//                         'url' => site_url()
//                     ]);
//                 }

//             }else{
//                 echo json_encode([
//                     'status'=>0,
//                     'msg'=>"Email Do Not Match Any Credentials"
//                 ]);
//             }
//         }
//     }

//     public function verify_token($token){
//         $check = $this->db->get_where('users', ['token'=>$token])->row();
//         if($check){
//             $this->session->set_userdata('r_data', $check);
//             redirect(site_url('?modal=reset'));
//         }else{
//             echo "An Error occured";
//         }
//     }

//     public function reset(){
//         $this->form_validation->set_rules('password', 'Password', 'required|max_length[16]|min_length[8]');
//         $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'matches[password]');
//         if($this->form_validation->run() === false){
//             echo json_encode([
//                 'status' => 0,
//                 'msg' => validation_errors()
//             ]);
//         }else{
//             $user_info = $this->session->userdata('r_data');
//             $this->session->unset_userdata('r_data');
//             $_POST['password'] = md5($this->input->post('password'));
//             unset($_POST['confirm_password']);
            
//             if($this->db->where('user_id', $user_info->user_id)->update('users', $this->input->post())){
//                 echo json_encode([
//                     'status' => 1,
//                     'msg' => 'Password Reset Successfull',
//                     'url' => site_url('?modal=login'),
//                 ]);
//             }
            
//         }
//     }


    


}
?>
