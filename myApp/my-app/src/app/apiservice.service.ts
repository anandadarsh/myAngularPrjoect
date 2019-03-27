import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from  "@angular/common/http";
import { Observable } from 'rxjs';


@Injectable({
  providedIn: 'root'
})
export class ApiserviceService {
  

  constructor(private HttpClient: HttpClient) { }

  	getAllRecord():Observable<any[]>{
  		return this.HttpClient.get<any[]>('http://localhost:3000/getContacts');
  	}

  	DeleteRecord(id){
    	return this.HttpClient.get('http://localhost:3000/delete/'+id,{
  			params: new HttpParams().append('token',localStorage.getItem('token'))
  		});
  	
  	}

  getRecordById(id){
  		return this.HttpClient.get('http://localhost:3000/edit/'+id);
	}

	updateForm(formdata,id){
		return this.HttpClient.post('http://localhost:3000/update/'+id,formdata,{
	  		params: new HttpParams().append('token',localStorage.getItem('token'))
  		});
	}

	insertRecord(formdata){
		return this.HttpClient.post('http://localhost:3000/insert',formdata);
	}

	getLikeRecord(data):Observable<any[]>{
		return this.HttpClient.get<any[]>('http://localhost:3000/search/'+ data);
	}

	getLogin(data):Observable<any[]>{
		return this.HttpClient.post<any[]>('http://localhost:3000/login', data,{
			params: new HttpParams().append('token',localStorage.getItem('token'))
		});
	}
	// isCheckdLogin():Observable<any>{
	// 	return  this.HttpClient.get<any[]>('http://localhost:3000/verifyUsers',{
	// 		params: new HttpParams().append('token',localStorage.getItem('token'))
	// 	 });
	// }  
}
