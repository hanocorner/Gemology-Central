$(function () {

    /** Variables  **/
    var downloadbtn = document.getElementById('downloadBtn');
    var canvas = document.getElementsByTagName("canvas");
    var repid = document.getElementById('repID'); 
    /** Functions **/
    html2canvas(document.querySelector("#capture")).then(canvas => {
        document.getElementById('exCanvas').appendChild(canvas)
    });

    var download = function (canvas, filename) {
        /// create an "off-screen" anchor tag
        var lnk = document.createElement('a'),
            e;

        /// the key here is to set the download attribute of the a tag
        lnk.download = filename;

        /// convert canvas content to data-uri for link. When download
        /// attribute is set the content pointed to by link will be
        /// pushed as "download" in HTML5 capable browsers
        lnk.href = canvas[0].toDataURL("image/png");

        /// create a "fake" click-event to trigger the download
        if (document.createEvent) {
            e = document.createEvent("MouseEvents");
            e.initMouseEvent("click", true, true, window,
                0, 0, 0, 0, 0, false, false, false,
                false, 0, null);

            lnk.dispatchEvent(e);
        } else if (lnk.fireEvent) {
            lnk.fireEvent("onclick");
        }
    };

    /** Binding */

    downloadbtn.onclick = function(event){
        event.preventDefault();
        download(canvas, repid.value+'.png');
    }
    
});