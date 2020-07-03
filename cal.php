<script type="text/javascript"> 
                                // 1 detik = 1000 
                                window.setTimeout("waktu()",1000);   
                                function waktu() {    
                                    var tanggal = new Date();   
                                    setTimeout("waktu()",1000);   
                                   document.getElementById("output").innerHTML = tanggal.getHours()+":"+tanggal.getMinutes()+":"+tanggal.getSeconds(); 
                               } 
                               </script> 
                               </head>
                               <body bgcolor="white" text="black" onload="waktu()">
                               <table align=center style="border:1px solid black" bgcolor="#CCCCCC"><tr><td> 
                               <div id="output"> 
                               </div></td></tr> 
                               </table>
Script PHP untuk menghasilkan Kalender :
<script>
            var tod=new Date();
            var weekday=new Array("Minggu","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu");
            var monthname=new Array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
            var y = tod.getFullYear();
            var m = tod.getMonth();
            var d = tod.getDate();
            var dow = tod.getDay();
            var dispTime = " " + weekday[dow] + ", " + d + " " + monthname[m] + " " + y + " ";
            if (dow==0) dispTime= "<font color=red>" + dispTime + "</font>"; else if (dow==5) dispTime= "<font color=green>" + dispTime + "</font>";
            else dispTime= "<font color=black>" + dispTime + "</font>";
            document.write(dispTime);
        </script> 