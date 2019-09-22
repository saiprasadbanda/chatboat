<?php

class Emailcomm 
{
	 
	var $to;
	var $subject;
	var $message;
	var $from='From:';    
	 
	function Emailcomm()
	{
		$this->CI=&get_instance();   
		

		$config['protocol'] = "smtp";
		$config['smtp_host'] = "mail.secondopinion.co.in";
		$config['smtp_port'] = "26"; 
		$config['smtp_user'] = "admin@secondopinion.co.in";
		$config['smtp_pass'] = "admin@123";   
		$config['charset'] = "'utf-8";
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = "html";
		$config['newline'] = "\r\n";
                $config['crlf'] = "\r\n";
	  //$config['protocol'] = 'sendmail';
       //$config['mailpath'] = '/usr/sbin/sendmail';
       //$config['charset'] = 'iso-8859-1';
        //$config['wordwrap'] = TRUE;
		 //$config['mailtype'] = 'html';
		$this->CI->load->library('email');
		
         $this->CI->email->initialize($config);
    }
	

	/*send mail to company mail id */
	
	function user_details($info)
	{
		$this->CI->email->clear(); 
		$this->message=$info['message']; 
		$this->to=$info['to_mail'];
		$this->subject='JISFA Login Credentials';
		$this->from='admin@secondopinion.co.in'; 
		$this->CI->email->from($this->from);
		$this->CI->email->to($this->to);
      
		$this->CI->email->subject($this->subject);
		$this->CI->email->message($this->message); 
		//echo $this->CI->email->print_debugger();
	  if($this->CI->email->send())
            return 1;  
        else
            return 0;  
	}
   function forgot_pass($info)
    {
        $this->CI->email->clear();
        $this->message=$info['message'];
        $this->to=$info['to_mail']; 
        $this->subject=$info['subject'];
        $this->from='admin@secondopinion.co.in'; 
        $this->CI->email->from($this->from);
        $this->CI->email->to($this->to); 
        $this->CI->email->subject($this->subject);
        $this->CI->email->message($this->message); 
      

        if($this->CI->email->send())
            return 1;
        else
            return 0;
    }
	function doctor_reply($info)
    {
        $this->CI->email->clear();
        $this->message=$info['message'];
        $this->to=$info['to_mail']; 
        $this->subject=$info['subject']; 
        //$this->attachs=$info['attachs']; 
        $this->from=$info['from'];//'admin@secondopinion.co.in'; 
        $this->CI->email->from($this->from);
        $this->CI->email->to($this->to); 
        $this->CI->email->subject($this->subject);
		if($info['attachs'])
		{
			$this->CI->email->attach($info['attachs']);
		}
        
		
        $this->CI->email->message($this->message); 
      

        if($this->CI->email->send())
            return 1;
        else
            return 0;
    }
    function testmail()
	{
		$this->CI->email->clear(); 
		$this->message='test mail';
		$this->to='vijaykumarpulipalupula@gmail.com';
		$this->subject='testmail'; 
		$this->from='admin@secondopinion.co.in';
		$this->CI->email->from($this->from);
		$this->CI->email->to($this->to);
		$this->CI->email->subject($this->subject);
		$this->CI->email->message($this->message);
		
	  if($this->CI->email->send())
            return 1;  
        else
            return 0;  
	} 
	
	

	
	
}


