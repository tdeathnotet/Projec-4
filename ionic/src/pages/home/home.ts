import { Component } from '@angular/core';
import { NavController } from 'ionic-angular';

import { DetailPage } from './../detail/detail';

import * as firebase from 'Firebase';

@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})

export class HomePage {

  notes: Array<any>;

  constructor(public navCtrl: NavController) {
    firebase.database().ref('/notes').on('value', res => {
      this.notes = res.val()
    })
  }

  onClickPushBtn() {
    this.navCtrl.push(DetailPage);
  }

}
