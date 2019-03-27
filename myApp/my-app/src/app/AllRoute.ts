import { Routes } from '@angular/router';
import { AboutComponent } from './about/about.component';
import { ContactComponent } from './contact/contact.component';
import { LoginComponent } from './login/login.component';
import { HomeComponent } from './home/home.component';
import { EditContactComponent } from './edit-contact/edit-contact.component';
import { MyguardGuard } from './myguard.guard';


export const AppRoutes:Routes = [
    {
        path: '',
        component: HomeComponent
    }, 
    {
        path: 'home',
        component: HomeComponent
    }, 
    {
        path: 'about',
        canActivate: [MyguardGuard],
        component: AboutComponent,
       
    },
    {
        path: 'contact',
        component: ContactComponent
    },
    {
        path: 'login',
        component: LoginComponent,
       
    },
    {
        path: 'edit-contact/:id',
        component:EditContactComponent 
    },
]

