import { Component } from '@angular/core';
import { Platform } from 'ionic-angular';
import { StatusBar } from '@ionic-native/status-bar';
import { SplashScreen } from '@ionic-native/splash-screen';

import { HomePage } from '../pages/home/home';

import * as firebase from 'firebase';

const config = {
  apiKey: "AIzaSyABZlHOrmjuVgebZkg7RJR9cCrnRoK_rFA",
  authDomain: "manga-209c3.firebaseapp.com",
  databaseURL: "https://manga-209c3.firebaseio.com",
  projectId: "manga-209c3",
  storageBucket: "manga-209c3.appspot.com",
  messagingSenderId: "194858820921"
};

@Component({
  templateUrl: 'app.html'
})
export class MyApp {
  rootPage: any = HomePage;

  constructor(platform: Platform, statusBar: StatusBar, splashScreen: SplashScreen) {
    platform.ready().then(() => {
      statusBar.styleDefault();
      splashScreen.hide();
    });

    firebase.initializeApp(config);

  }

}

