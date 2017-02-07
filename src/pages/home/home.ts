import { Component } from '@angular/core';
import { NavController } from 'ionic-angular';
import { VarsGlobales } from '../../providers/vars-globales';
import { BirdsService } from '../../providers/birds-service';

/*
  Generated class for the Home page.

  See http://ionicframework.com/docs/v2/components/#navigation for more info on
  Ionic pages and navigation.
*/
@Component({
  selector: 'page-home',
  templateUrl: 'home.html',
  providers: [BirdsService]
})
export class Home {

  constructor(public navCtrl: NavController, public varsGlobales: VarsGlobales, public servicios: BirdsService)
  {

  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad HomePage');
  }

}
