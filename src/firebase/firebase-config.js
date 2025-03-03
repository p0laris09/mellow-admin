import { initializeApp } from "https://www.gstatic.com/firebasejs/9.14.0/firebase-app.js";
import { getAuth } from "https://www.gstatic.com/firebasejs/9.14.0/firebase-auth.js";

const firebaseConfig = {
  apiKey: "AIzaSyBhktkOTnniR7a18F8xPdEDgiihQh0j5ls",
  authDomain: "auth-mellow.firebaseapp.com",
  projectId: "auth-mellow",
  storageBucket: "auth-mellow.appspot.com",
  messagingSenderId: "924615431516",
  appId: "1:924615431516:web:17e0cb9bc5ece1d2fddd99",
  measurementId: "G-CQ7BCGC61J"
};

const app = initializeApp(firebaseConfig);
const auth = getAuth(app);

export { auth };