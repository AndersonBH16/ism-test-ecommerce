import { Component, EventEmitter, Output, OnInit } from '@angular/core';
import { AuthService } from "../../../core/auth.service";
import { Router } from "@angular/router";
import { CartService, CartItem } from "../../../cart.service";

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
    this.cartService.cartItems$.subscribe((items: CartItem[]) => {
      this.cartItemCount = items.length;
    });
  }

  logout(): void {
    this.auth.logout().subscribe(() => {
      localStorage.removeItem('token');
      this.router.navigate(['/login']);
    });
  }
}
