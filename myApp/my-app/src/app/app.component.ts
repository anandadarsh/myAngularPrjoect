import { Component } from '@angular/core';
import { Route, Router } from '@angular/router';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css'],
})
export class AppComponent implements OnInit {
  constructor(private _router:Router){}
  title = 'my-app';
  isLogedin:any


		ngOnInit(){
		this.isLogedin = localStorage.getItem('token');
     
    }
    logout(){
      localStorage.clear();
      this._router.navigate(['/login']);
    }

}

