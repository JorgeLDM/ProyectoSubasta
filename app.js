// Initialize Cloud Firestore through Firebase
firebase.initializeApp({
  apiKey: "AIzaSyCeOZ_7r_26oiA7UvFRWAKEUFfkYyko_Sc",
  authDomain: "proveesubasta.firebaseapp.com",
  projectId: "proveesubasta"
});

var db = firebase.firestore();

db.collection("users").add({
    first: "Ada",
    last: "Lovelace",
    born: 1815
})
.then(function(docRef) {
    console.log("Document written with ID: ", docRef.id);
})
.catch(function(error) {
    console.error("Error adding document: ", error);
});