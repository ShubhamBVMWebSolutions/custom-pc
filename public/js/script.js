window.onload=function(){

    magnifyImage();
}

function magnifyImage(){
        var container_img = document.getElementById("container_img");
        var img = document.querySelector(".tab-pane.active img");
        console.log(img);
        container_img.addEventListener("mousemove", onZoom);
        container_img.addEventListener("mouseover", onZoom);
        container_img.addEventListener("mouseleave", offZoom);
    
        function onZoom(e) {
            let x = e.clientX - e.target.offsetLeft;
            let y = e.clientY - e.target.offsetTop;
    
            console.log(x, y)
            // console.log(x-100, y-100)
    
            img.style.transformOrigin = `${x-400}px ${y-400}px`;
            img.style.transform = "scale(1.5)";
        }
    
        function offZoom(e) {
            img.style.transformOrigin = `center center`;
            img.style.transform = "scale(1)";
            console.log(img.style.transformOrigin);
        }
        
    // setInterval(magnifyImage, 500);    
}

$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
   magnifyImage();
})