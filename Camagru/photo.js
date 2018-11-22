(function (){

    var video = document.getElementById('video'),
        canvas = document.getElementById('canvas'),
        canvas2 = document.getElementById('canvas2'),
        context = canvas.getContext('2d'),
        context2 = canvas2.getContext('2d'),
        yaboi = document.getElementById('yaboi'),
        locks = document.getElementById('locks'),
        shades = document.getElementById('shades'),
        save = document.getElementById('save'),
        image = document.getElementById('image'),
        input = document.getElementById('input');
        vendorURL = window.URL || window.webkitURL;
    
        navigator.getMedia =    navigator.getUserMedia ||
                                navigator.webkitGetUserMedia ||
                                navigator.mozGetUserMedia ||
                                navigator.msGetUserMedia;
        
        navigator.getMedia({
            video: true,
            audio: false
        }, function(stream){
            video.srcObject = stream;
            video.play();
        }, function(error){
            // error.code
        });
        document.getElementById('click').addEventListener('click', function(){
            context.drawImage(video, 0, 0, 400, 300);
            context2.drawImage(video,0, 0, 400, 300);
            save.setAttribute("style", "display: block");
            image.setAttribute("style", "display: block");
            image.src = canvas.toDataURL("image/png");
            canvas2.setAttribute("style", "display:none");           
            input.setAttribute("value", image.src);
        });
        yaboi.addEventListener('click', function(){
            console.log("shet");
            context2.drawImage(yaboi, 155, 50, 200, 200);
            canvas2.setAttribute("style", "display: block");
            image.setAttribute("style", "display:none");
            image.src= canvas2.toDataURL("image.png");
            input.setAttribute("value", image.src);
        });
        locks.addEventListener('click', function(){
            console.log("shet");
            context2.drawImage(locks, 145, 50, 200, 200);
            canvas2.setAttribute("style", "display: block");
            image.setAttribute("style", "display:none");
            image.src= canvas2.toDataURL("image.png");
            input.setAttribute("value", image.src);
            
        });
        shades.addEventListener('click', function(){
            console.log("shet");
            context2.drawImage(shades, 85, 100, 150, 150);
            canvas2.setAttribute("style", "display: block");
            image.setAttribute("style", "display:none");
            image.src= canvas2.toDataURL("image.png");
            input.setAttribute("value", image.src);
        });
        

    })();
    
        var file = document.forms.save_form;
    
        function save(file){
            xhr = new XMLHttpRequest();
            xhr.open('POST', 'save_img.php');
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send();
        };