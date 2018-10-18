( function( $ ) {

  $(function() {
    let recorder = null;
    let audio = null;
    // :: FUNCTION FOR RECORDING AUDIO STARTs ;:
    const recordAudio = () => {
      return new Promise(resolve => {
        navigator.mediaDevices.getUserMedia({ audio: true })
          .then(stream => {
            const mediaRecorder = new MediaRecorder(stream);
            const audioChunks = [];

            mediaRecorder.addEventListener("dataavailable", event => {
              audioChunks.push(event.data);
            });

            const start = () => {
              mediaRecorder.start(3000);
            };

            const stop = () => {
              return new Promise(resolve => {
                mediaRecorder.addEventListener("stop", () => {
                  const audioBlob = new Blob(audioChunks);
                  const audioUrl = URL.createObjectURL(audioBlob);
                  const audio = new Audio(audioUrl);
                  const audioObject = audio;
                  const play = () => {
                    audio.play();
                  };

                  resolve({ audioBlob, audioUrl, play, audioObject });
                });

                mediaRecorder.stop();
              });
            };

            resolve({ start, stop });
          });
      });
    };
    const sleep = time => new Promise(resolve => setTimeout(resolve, time));

    const recordStop = async (id, user, element) => {
      if (recorder) {
        $(element).find('.record-audio:first').css('background-color', 'rgba(0, 0, 0, 0.3)');

        audio = await recorder.stop();
        audio.play();
        var file = new FileReader();
        file.readAsDataURL(audio.audioBlob);
        console.log(id, user);
        file.onloadend = function(e){
          $.ajax({
            url: "/uploadSound.php",
            type: "POST",
            data: JSON.stringify({
              "file": file.result,
              "user": user,
              "id": id
            }),
            processData: false,
            contentType : "application/json"
          });
      }
        recorder = null;
      } else {
          recorder = await recordAudio();
          recorder.start();
          $(element).find('.record-audio:first').css('background-color', '#ff0000');
          await sleep(30000);
          if(recorder) {
          $(element).find('.record-audio:first').css('background-color', 'rgba(0, 0, 0, 0.3)');
          audio = await recorder.stop();
          audio.play();
          var file = new FileReader();
          file.readAsDataURL(audio.audioBlob);
          console.log(id, user);
          file.onloadend = function(e){
            $.ajax({
              url: "/uploadSound.php",
              type: "POST",
              data: JSON.stringify({
                "file": file.result,
                "user": user,
                "id": id
              }),
              processData: false,
              contentType : "application/json"
            });
        }

      }
      }
    };
    const playAudio = () => {
      if (audio && typeof audio.play === "function") {
        audio.play();
      }
    };
    // :: FUNCTION FOR RECORDING AUDIO END;:


    // :: READ MORE FEATURE ::
    $( ".read-more" ).hover( function() {
    	$(this).parents('.format-link').css('z-index', 999);
    	$( this ).next().slideToggle( "slow" );
    });
    // :: END OF READ MORE FEATURE ::




    // :: START OF AUDIO PLAYING ::
    var arrayOfAudioObjects = [];

    $('.audio').each( function( index, el ) {
      arrayOfAudioObjects[$(this).data('id')] = new Audio($(this).data('audio'));
    });


    var audioPlaying = false;

    $('.audio').click(function() {
      let id = $(this).data('id');
      arrayOfAudioObjects.forEach((item, index) => {
        if(index != id) {
          $('.audio').each( function( index, el ) {
            $(this).find(">:first-child").html("<i class='fa fa-play'></i>");
          });
          arrayOfAudioObjects[index].pause();
        }
      });

      if(arrayOfAudioObjects[id].paused) {
        $(this).find(">:first-child").html("<i class='fa fa-pause'></i>")
        arrayOfAudioObjects[id].play();
      } else {
        $(this).find(">:first-child").html("<i class='fa fa-play'></i>")
        arrayOfAudioObjects[id].pause();
      }
    });


    $('.record').click(function() {
      let id = $(this).data('id');
      let user = $(this).data('user');
      // $(this).find('.record-audio:first').css('background-color', '#ff0000');
      recordStop(id, user, $(this));

      // setInterval(function(){
        // recordStop(id, user, $(this));
        // );

    });

  } );
} )( jQuery );
