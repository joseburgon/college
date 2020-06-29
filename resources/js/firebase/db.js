import firebase from "firebase";
import "firebase/firestore";

// Your web app's Firebase configuration
var firebaseConfig = {
  apiKey: "AIzaSyDdZdqifEgZmmuxsdyuxpblAJFP9MeCj24",
  authDomain: "lvr-college.firebaseapp.com",
  databaseURL: "https://lvr-college.firebaseio.com",
  projectId: "lvr-college",
  storageBucket: "lvr-college.appspot.com",
  messagingSenderId: "597156703850",
  appId: "1:597156703850:web:417567933be47801776413",
};
// Initialize Firebase

export const db = firebase.initializeApp(firebaseConfig).firestore();
