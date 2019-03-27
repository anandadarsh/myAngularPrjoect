import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, FormControl ,Validators } from '@angular/forms';

import { Router } from '@angular/router';
import { ApiserviceService } from '../apiservice.service';


@Component({
  selector: 'app-edit-contact',
  templateUrl: './edit-contact.component.html',
  styleUrls: ['./edit-contact.component.css']
})

export class EditContactComponent implements OnInit {
	path :String;
	urlArray :any[];
	id:String;
	sampleData:any[];

  contactForm: FormGroup;



  
  constructor(
  				private Myservice:ApiserviceService,
  				private router:Router,
  				private formBuilder: FormBuilder
  			) { }

  ngOnInit() {

  this.path = this.router.url;
  	this.urlArray = this.path.split('/');
  	this.id = this.urlArray[2];
  	this.getRecordById(this.id)

  	this.createForm();

  	}

  	getRecordById(id){
  		this.Myservice.getRecordById(id).subscribe(data=>{
  		 this.contactForm.setValue({"fname":data[0].fname, "lname":data[0].lname, "email":data[0].email});	
  	})
  }

	onSubmit(form){
		 this.Myservice.updateForm(this.contactForm.value,this.id).subscribe(data=>{
			this.router.navigate(['/contact'])
		})
	}

 

	createForm() {
		  this.contactForm = this.formBuilder.group({
		    'fname':['', Validators.required],
		    'lname':['', Validators.required],
		     'email':['', Validators.required],

		  });

}

}


