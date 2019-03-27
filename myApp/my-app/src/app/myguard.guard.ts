import { Injectable } from '@angular/core';
import { CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot, UrlTree, Router } from '@angular/router';
import { Observable } from 'rxjs';
import { ApiserviceService } from './apiservice.service';


@Injectable({
  providedIn: 'root'
})
export class MyguardGuard implements CanActivate {
  constructor(private Myrouter: Router,private MyServices:ApiserviceService){}
   isLoged:string = '0';
  canActivate(
    next: ActivatedRouteSnapshot,
    state: RouterStateSnapshot): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree {
      if( localStorage.getItem('token')){
          return true;
      }else{
        alert('Please login');
           this.Myrouter.navigate(['/login']);
      }
  }
  
}
