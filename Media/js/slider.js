    function Slider(slider){
            this.slider     = slider;
            this.mover      = slider.querySelector(".mover");
            this.leftbtn    = slider.querySelector(".arrowleft");
            this.rightbtn   = slider.querySelector(".arrowright");
            this.timer      = null;
            this.pause      = false;

            var sl_count=this.mover.children.length;
            this.mover.style.width = 100*(sl_count)+"%";
            var self = this;
            var active_slide=0;
            this.leftbtn.addEventListener("click",function(){
                self.slideLeft();
            })
            this.rightbtn.addEventListener("click",function(){
                self.slideRight();
            })

            setInterval(function(){
                if(self.pause) return;
                self.slideLeft();
            },5000);

            this.slideLeft = function(speedy,onend){
                if(this.timer!==null) return;
                active_slide<(sl_count-1) ? active_slide++ : active_slide = 0;
                var startpos = 0;
                this.timer = setInterval(function(){
                    startpos-=speedy?10:2;
                    self.mover.style.marginLeft = startpos+"%";
                    if(startpos==-100) {
                        clearInterval(self.timer);
                        self.mover.append(self.mover.firstElementChild);
                        self.mover.style.marginLeft="";
                        self.timer=null;
                        if(onend) onend();
                    }
                },10);
            }

            this.slideRight = function(speedy,onend){
                if(this.timer!==null) return;
                active_slide>0 ? active_slide-- : active_slide=sl_count-1;
                var startpos = -100;
                self.mover.prepend(self.mover.lastElementChild);
                self.mover.style.marginLeft = startpos+"%";
                this.timer = setInterval(function(){
                    startpos+=speedy?10:2;
                    self.mover.style.marginLeft = startpos+"%";
                    if(startpos==0) {
                        clearInterval(self.timer);
                        self.mover.style.marginLeft="";
                        self.timer=null;
                        if(onend) onend();
                    }
                },10);
            }
        }

        window.onload=function(){
            var s = document.querySelector(".slider_top_note");
            if($('.mover a').length>1){
                var slider = new Slider(s);   
            }
        }
