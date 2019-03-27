import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { ApiserviceService } from './apiservice.service';
import { HttpClientModule } from  '@angular/common/http';
import { ReactiveFormsModule  } from '@angular/forms';
import { NgxPaginationModule} from 'ngx-pagination';      
import { FormsModule }   from '@angular/forms';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { AboutComponent } from './about/about.component';
import { ContactComponent } from './contact/contact.component';
import { LoginComponent } from './login/login.component';
import { HomeComponent } from './home/home.component';
import { EditContactComponent } from './edit-contact/edit-contact.component';
import { SubAboutComponent } from './about/sub-about/sub-about.component';
import { AppRoutes } from './AllRoute';
import { MyguardGuard } from './myguard.guard';

@NgModule({
  declarations: [
    AppComponent,
    AboutComponent,
    ContactComponent,
    LoginComponent,
    HomeComponent,
    EditContactComponent,
    SubAboutComponent,

 ],
  imports: [
    BrowserModule,
    FormsModule,
    AppRoutingModule,
    HttpClientModule,
    ReactiveFormsModule,
    NgxPaginationModule,
   
    RouterModule.forChild(AppRoutes),
  ],
  providers: [ApiserviceService, MyguardGuard],
  bootstrap: [AppComponent],

})
export class AppModule { }