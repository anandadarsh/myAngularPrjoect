import { Component, OnInit } from '@angular/core';
import { ApiserviceService } from '../apiservice.service';
import { Router } from '@angular/router';
import { FormBuilder, FormGroup, FormControl ,Validators } from '@angular/forms';
import swal from 'sweetalert';

@Component({
  selector: 'app-contact',
  templateUrl: './contact.component.html',
  styleUrls: ['./contact.component.css']
})
export class ContactComponent implements OnInit {
myData:any[];	
msg : String;
insertForm: FormGroup;	
inpp = 'ram';
isLogedin:any;
 constructor(private MyService:ApiserviceService,private router: Router,private fb : FormBuilder) { }

  ngOnInit() {
  	this.getAllrecord();
		this.createForm();
		this.isLogedin = localStorage.getItem('logedInUser');
  }

	getAllrecord()
	{
			this.MyService.getAllRecord().subscribe(data=>{
			this.myData = data
		
		})
	}

  

	askFordelete(id){
			swal({
  				title: "Are you sure?",
  				text: "Once deleted, you will not be able to recover this imaginary file!",
  				icon: "warning",
  				buttons: true,
  				dangerMode: true,
			}).then((willDelete) => {
	 		 if (willDelete) {
	    		this.DeleteRecord(id);
	  		} 
		});

		}



	DeleteRecord(id){

			this.MyService.DeleteRecord(id).subscribe(
			data=>{
				this.msg = 'record has been deleted',
				swal("Good job!", "Record has been Deleted!", "success");
				this.getAllrecord();
				
			},
		error=>{
			localStorage.clear();
			console.log(localStorage.getItem('token'))
				swal({
  						title: "Oops!",
 						 text: "You Must login for delete this!",
 						 icon: "warning",
 						 button: "Got it"
				});
				this.router.navigate(['/login'])
			}
		)

  	}
  	
	createForm() {
		  this.insertForm = this.fb.group({
		    'fname':['', Validators.required],
		    'lname':['', Validators.required],
		     'email':['', Validators.compose([Validators.required, Validators.pattern("[^ @]*@[^ @]*")])],
		     'id':'',

		  });

	}
	onInsertSubmit(){
		 $('.modal').modal('hide');
		 if(this.insertForm.value.id == null){
		 	this.insertRecord({"fname":this.insertForm.value.fname,"lname":this.insertForm.value.lname,"email":this.insertForm.value.email });
		}
		else{
			this.updateRecord({"fname":this.insertForm.value.fname,"lname":this.insertForm.value.lname,"email":this.insertForm.value.email },this.insertForm.value.id);
		}
		
	}

	editForm(data){
			console.log(localStorage.getItem('token'));
			if(localStorage.getItem('token')){
					this.insertForm.setValue({"fname":data.fname, "lname":data.lname, "email":data.email, "id":data._id});
					$('.modal').modal('show');
				}
				else
				{
						swal({
  								title: "Oops!",
 						 		text: "You Must login for Edit this!",
 						 		icon: "warning",
 						 		button: "Got it",
						});
						this.router.navigate(['/login'])
			    }
			 	
			}
	 


showModel(){
	$('.modal').find('form').trigger('reset');
}

insertRecord(data){
	this.MyService.insertRecord(data).subscribe(data=>{
			this.msg = 'Record has been inserted'
			this.getAllrecord();
			$('.modal').find('form').trigger('reset');
		})
}

updateRecord(data,id){
	this.MyService.updateForm(data,id).subscribe(
	data=>{
			this.msg = 'Record has been updated'
			this.getAllrecord();
			$('.modal').find('form').trigger('reset');
		},
	error=>this.router.navigate(['/login'])	
		)   
}
onKeydownEvent(){
	var txt = $('#serchBox').val();
	if(txt == '')
	{
		this.getAllrecord();
	}else{
		this.getLikeRecord(txt);
	}

}

getLikeRecord(txt){
	this.MyService.getLikeRecord(txt).subscribe(data=>{
	this.myData = data
});
}




	isRequired(fc){
				return this.insertForm.get(fc).hasError('required') && this.insertForm.get(fc).touched;
	}

	
	
}
