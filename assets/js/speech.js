

function spInit(text) {
    let speech = new SpeechSynthesisUtterance();
    speech.lang = "en";
    let voices = []; // global array of available voices
    voices = window.speechSynthesis.getVoices();
    speech.voice = voices[0];
    speech.rate = 1;
    speech.volume = 1;
    speech.pitch = 1;

    return speech;
}
function speakNow(speech, text) {
    speech.text = text;
    window.speechSynthesis.speak(speech);
}







