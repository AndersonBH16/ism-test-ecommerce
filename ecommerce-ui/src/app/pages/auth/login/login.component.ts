import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/core/auth.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent {
  email = '';
  password = '';

  constructor(private auth: AuthService, private router: Router) {
  }

  login() {
    this.auth.login(this.email, this.password).subscribe((res: any) => {
      this.auth.setToken(res.token);
      this.router.navigate(['/home']);
    });
  }
}
