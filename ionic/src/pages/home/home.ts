import { Component } from '@angular/core';
import { NavController, ModalController } from 'ionic-angular';

import { DetailPage } from './../detail/detail';

import * as firebase from 'Firebase';

@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})

export class HomePage {

  notes: Array<any>;

  constructor(public navCtrl: NavController, private modalCtrl: ModalController) {
    let arr = [];
    firebase.database().ref('/').on('value', res => {
       arr = res.val().notes
       this.notes = arr;
    })
  }

  onClickPushBtn() {
    this.navCtrl.push(DetailPage);
  }

}
