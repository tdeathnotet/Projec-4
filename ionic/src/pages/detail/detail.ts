import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { HomePage } from '../home/home';

@IonicPage()
@Component({
  selector: 'page-detail',
  templateUrl: 'detail.html',
})

export class DetailPage {

  constructor(public navCtrl: NavController, public navParams: NavParams) {

  }

  onClickPushBtn(){
    this.navCtrl.pop();
  }

}
