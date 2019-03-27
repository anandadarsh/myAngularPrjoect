import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-about',
  templateUrl: './about.component.html',
  styleUrls: ['./about.component.css']
})
export class AboutComponent implements OnInit {

  constructor() { }
  inputVariable:String;
  ngOnInit() {
  this.inputVariable = "Hi this is parent Component class"
  }
 
}
