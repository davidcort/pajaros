import { NgModule, ErrorHandler } from '@angular/core';
import { IonicApp, IonicModule, IonicErrorHandler } from 'ionic-angular';
import { MyApp } from './app.component';
import { Home } from '../pages/home/home';
import { List } from '../pages/list/list';
import { Add } from '../pages/add/add';
import { Update } from '../pages/update/update';
import { VarsGlobales } from '../providers/vars-globales';

@NgModule({
  declarations: [
    MyApp,
    Home,
    List,
    Add,
    Update
  ],
  imports: [
    IonicModule.forRoot(MyApp)
  ],
  bootstrap: [IonicApp],
  entryComponents: [
    MyApp,
    Home,
    List,
    Add,
    Update
  ],
  providers: [VarsGlobales]
})
export class AppModule {}
