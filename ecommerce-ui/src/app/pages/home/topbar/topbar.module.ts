import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { TopbarRoutingModule } from './topbar-routing.module';
import { TopbarComponent } from './topbar.component';
import {MatToolbarModule} from "@angular/material/toolbar";
import {MatButtonModule} from "@angular/material/button";
import {MatIconModule} from "@angular/material/icon";
import {MatSidenavModule} from "@angular/material/sidenav";
import {MatMenuModule} from "@angular/material/menu";


@NgModule({
  declarations: [
    TopbarComponent
  ],
  exports: [
    TopbarComponent
  ],
  imports: [
    CommonModule,
    TopbarRoutingModule,
    MatToolbarModule,
    MatButtonModule,
    MatIconModule,
    MatSidenavModule,
    MatMenuModule
  ]
})
export class TopbarModule { }
