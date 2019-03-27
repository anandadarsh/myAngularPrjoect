import { Component, OnInit ,Output,EventEmitter} from '@angular/core';
import { ApiserviceService } from '../apiservice.service';
import { Router } from '@angular/router';
import { FormBuilder, FormGroup, FormControl ,Validators } from '@angular/forms';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
	@Output() output:EventEmitter<string>=new EventEmitter();
outputString = 'i am your child';
msg:String;
  constructor(
  				private MyService:ApiserviceService,
  				private router:Router,
  				private fb:FormBuilder
  				
  			) { }

loginForm:FormGroup
  ngOnInit() {
		this.createForm();
		localStorage.clear();
  }

createForm(){
	this.loginForm = this.fb.group({
  	 'fname':['', Validators.required],
  	 'email':['', Validators.required]
	})
}
  
	onloginSubmit(){
			
				this.MyService.getLogin(this.loginForm.value).subscribe(data=>{
						if(data.status == 1){
							localStorage.setItem("token",'Bearer'+" "+data.token);
							localStorage.setItem("logedInUser",'1');
							this.output.emit(this.outputString)
							this.router.navigate(['/contact'])
						}else{
							this.msg = data.message
						}//end if 
				})
				
	}	 
	
}