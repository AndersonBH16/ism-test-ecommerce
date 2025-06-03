import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { LoginComponent } from './pages/auth/login/login.component';

const routes: Routes = [
  { path: '', redirectTo: 'login', pathMatch: 'full' },
  { path: 'login', component: LoginComponent },
  { path: 'home', loadChildren: () => import('./pages/home/home.module').then(m => m.HomeModule) },
  { path: 'catalog', loadChildren: () => import('./pages/catalog/catalog.module').then(m => m.CatalogModule) },
  { path: 'product/:id', loadChildren: () => import('./pages/product-detail/product-detail.module').then(m => m.ProductDetailModule) },
  { path: 'cart', loadChildren: () => import('./pages/cart/cart.module').then(m => m.CartModule) }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
