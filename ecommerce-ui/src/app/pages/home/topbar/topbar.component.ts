// src/app/pages/home/topbar/topbar.component.ts
import { Component, EventEmitter, Output, OnInit } from '@angular/core';
import { AuthService } from "../../../core/auth.service";
import { Router } from "@angular/router";
import { CartService } from "../../../cart.service";

@Component({
  selector: 'app-topbar',
  templateUrl: './topbar.component.html',
  styleUrls: ['./topbar.component.css']
})
export class TopbarComponent implements OnInit {
  @Output() toggleSidenav = new EventEmitter<void>();
  cartItemCount = 0;

  constructor(
    private auth: AuthService,
    private router: Router,
    private cartService: CartService
  ) {}

  ngOnInit(): void {
    this.cartService.cartItems$.subscribe((ids: number[]) => {
      this.cartItemCount = ids.length;
    });
  }

  logout(): void {
    this.auth.logout().subscribe(() => {
      localStorage.removeItem('token');
      this.router.navigate(['/login']);
    });
  }
}
