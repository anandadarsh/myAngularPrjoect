import { Component, OnInit ,Input} from '@angular/core';

@Component({
  selector: 'app-sub-about',
  templateUrl: './sub-about.component.html',
  styleUrls: ['./sub-about.component.css']
})
export class SubAboutComponent implements OnInit {
@Input() myinput:String;
myemail = "myemail@b2cdev.com"
  constructor() { }
  msg :String;
  ngOnInit() {
  console.log(this.myinput)
  this.msg = this.myinput
  }

  getEmail(){
	console.log("ook");
	console.log(this.myemail);
}
}
