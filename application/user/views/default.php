<?php $model = new UserModelDefault(); ?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>WildRide | Adrian-Nicolae Mihaila, Diana Alexandra Saveluc, Alin Paul Macovei</title>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
        <link rel="stylesheet" type="text/css" href="<?=WSystem::$url?>assets/css/main.css" /> 
        <link rel="stylesheet" href="<?=WSystem::$url?>assets/css/datepicker_bootstrap.css" > 
        <link rel="stylesheet" type="text/css" media="all" href="<?=WSystem::$url?>assets/css/jquery.hoverscroll.css" /> 
    </head>
    <body>
        <?php $result = $model->getUser(); ?>         
        <header>
            <div class="content">
                <div id="logo">
                    <a href="<?=WSystem::$url?>" alt=""><img src="<?=WSystem::$url?>img/logo.png" alt=""/></a>
                </div>
                <div id="navigator">
                    <nav>
                        <a href="<?=WSystem::$url?>about" title="About Us">about us</a>
                        <a href="<?=WSystem::$url?>search/filter/view_special_offers" title="Special Offers">special offers</a>
                        <a href="<?=WSystem::$url?>partners" title="Partners">partners</a>
                        <a href="<?=WSystem::$url?>contact" title="Contact">contact</a>
                    </nav>
                </div>
            </div>

            <?php  
                $model->getPositionStart($region_start,$city_start,$adress_start);
                $model->getPositionEnd($region_end,$city_end,$adress_end);
            ?>

        </header>
        <section id="search">
            <div class="content">
                <div id="left-content">
                    <h2>Search for a scooter hire</h2>
                    <form action="<?=WSystem::$url?>search/view" method="POST">
                        <label class="search-label">Region</label>
                        <div class="search-select">
                            <select name="region_start">
                                <option><?php echo $region_start;?></option>
                            </select>
                        </div>

                        <label class="search-label">City</label>
                        <div class="search-select">
                            <select name="city_start">
                                <option><?php echo $city_start;?></option>
                            </select>
                        </div>

                        <label class="search-label">Location</label>
                        <div class="search-select">
                            <select name="adress_start">
                                <?php echo $adress_start;?>
                            </select>
                        </div>

                        <input type="checkbox" name="return-another-place" id="input-label-return" onchange="showReturnLocationInputs(this)"/>
                        <label class="search-label-return">
                            Return scooter to the same location
                        </label>

                        <div id="inputs-label-return">
                            <label class="search-label">Region</label>
                            <div class="search-select">
                                <select name="region_end">
                                    <?php echo $region_end;?>
                                </select>
                            </div>

                            <label class="search-label">City</label>
                            <div class="search-select">
                                <select name="city_end">
                                    <?php echo $city_end;?>
                                </select>
                            </div>

                            <label class="search-label">Location</label>
                            <div class="search-select">
                                <select name="adress_end">
                                    <?php echo $adress_end;?>
                                </select>
                            </div>
                        </div>
                        <label class="search-label">Start Date</label>  
                        <input type="text" name="start-date" id="start-date" value="<?php echo date("m/d/Y H:iA");?>"/>

                        <label class="search-label">End Date</label>
                        <input type="text" name="end-date" id="end-date" value="<?php echo date("m/d/Y H:iA");?>"/>

                        <label class="search-label"></label>
                        <input type="submit" value="Search"/>

                    </form>
                </div>
                <div id="right-content">
                    <img src="<?=WSystem::$url?>img/happy_kids.png" alt="" width="500"/>
                </div>
            </div>
            <section id="aditional-tool"> 
                <div id="members-area">
                    <div id="members-area-content">
                        <h3>Members Area</h3>
                        <h4><?php 
                            if(is_array($result)){
                                echo 'Bune ai venit, <a href="'.WSystem::$url.'user/view"> ' . $result['nume'] ." ". $result['prenume'] ."</a>!</h4>";
                                echo '<input type="button" value="Logout" onclick="Logout()" class="input-logout"/>';
                            }else{
                                echo 'Welcome guest!</br>Please</h4>
                                <input type="button" value="Sign In" onclick="go(\'index\',\'login\');"/>
                                <div id="members-area-login">or</div>
                                <input type="button" value="Sign Up" onclick="go(\'index\',\'login\');"/>'; 
                            }                            
                        ?> 
                    </div>                        
                </div>
                <div id="weather">
                    <div id="weather-content">
                        <h3>Current Weather</h3>
                        <div id="weather-content"></div>
                    </div>                        
                </div>
                <div id="currency"> 
                    <div id="currency-content">
                        <?php $rates = $model->getExchangeRates();?>  
                        <h3>Currency Rates</h3>
                        <ul>
                            <li><img src="<?=WSystem::$url?>img/eur.png" alt="" width="25"/><?php echo '1 '.$rates[0]['from'].' - ' . number_format($rates[0]['to'], 2) . ' RON';?></li>
                            <li><img src="<?=WSystem::$url?>img/usd.png" alt="" width="25"/><?php echo '1 '.$rates[1]['from'].' - ' . number_format($rates[1]['to'], 2) . ' RON';?></li>
                            <li><img src="<?=WSystem::$url?>img/gbp.png" alt="" width="25"/><?php echo '1 '.$rates[2]['from'].' - ' . number_format($rates[2]['to'], 2) . ' RON';?></li>
                        </ul>
                        <input type="button" value="More" onclick="window.open('http://xe.com','_blank');"/>
                    </div>                     
                </div>                                   
            </section>
        </section>
        <section id="scooter-recomandation">
            <div class="content">
                <h2>Recomandation</h2>
                <ul id="horizontal-scooters-1">
                    <?php echo $model->getScootersRecomandation(); ?>   
                </ul>
            </div>
        </section>
        <section id="scooter-feed">
            <div class="content">
                <h2>New Deals</h2>
                <ul id="horizontal-scooters-2">
                    <?php echo $model->getScootersFeed(); ?>   
                </ul>
            </div>
        </section> 
        <footer>
            <div class="content">
                <section class="footer-content" style="margin-right: 67px;">
                    <h3>Quick Navigation</h3>
                    <ul>
                        <li><a href="<?=WSystem::$url?>" title="">Home</a></li>
                        <li><a href="<?=WSystem::$url?>about" title="">About Us</a></li>
                        <li><a href="<?=WSystem::$url?>search/filter/view_special_offers" title="">Special Offers</a></li>
                        <li><a href="<?=WSystem::$url?>partners" title="">Partners</a></li>
                        <li><a href="<?=WSystem::$url?>rentalConditions" title="">Rental Conditions</a></li>  
                        <li><a href="<?=WSystem::$url?>contact" title="">Contact</a></li>
                    </ul>
                </section>
                <section class="footer-content" style="margin-right: 66px;">
                    <h3>Contact</h3>
                    <p> Luni-Vineri: 8-20<br/>
                        Sambata-Duminica: 10-18</br>
                        Contact: 0756 318 976</br>
                        <font style="color : #dbdada;">...........</font>: 0760 489 168</br>
                        E-mail: office@wildride.ro
                    </p>
                </section>
                <section class="footer-content" style="margin-right: 67px;">
                    <h3>Keep in Touch</h3>
                    <ul>
                        <li><a href="https://www.facebook.com/WildrideBusiness" target="_blank" title="">Facebook</a></li>
                        <li><a href="https://twitter.com/WildRideProject" target="_blank" title="">Twitter</a></li>
                        <li><a href="https://plus.google.com/110979650659175550433" target="_blank" title="">Google+</a></li>
                        <li><a href="http://www.youtube.com/user/WildrideBusiness" target="_blank" title="">YouTube</a></li>
                        <li><a href="http://ro.linkedin.com/pub/wildride-business/73/791/5a9" target="_blank" title="">LinkedIn</a></li>
                        <li><a href="http://ro.wikipedia.org/wiki/Utilizator:WildrideBusiness" target="_blank" title="">Wikipedia</a></li>
                        <li><a href="http://wildrideproject/blog/" target="_blank" title="">Blog WildRide</a></li>
                    </ul>
                </section>
                <section class="footer-content">
                    <h3>Newsletter</h3>
                    <p>Keep up with new offers!</p>
                    <form action="<?=WSystem::$url?>newsletter" method="post">                            
                        <input type="email" name="email" id="email-newsletter" required="required">                             
                        <input type="submit" value="Subscribe"/>
                    </form>
                </section>
            </div>
        </footer>
        <div id="footer-copyright">
            Copyright © 2013 WildRide
        </div>

        <script src="<?=WSystem::$url?>assets/js/jquery-1.9.1.min.js" type="text/javascript" ></script> 
        <script src="<?=WSystem::$url?>assets/js/mootools-core.js" type="text/javascript"></script>
        <script src="<?=WSystem::$url?>assets/js/mootools-more.js" type="text/javascript"></script>
        <script src="<?=WSystem::$url?>assets/js/Locale.en-US.DatePicker.js" type="text/javascript"></script>
        <script src="<?=WSystem::$url?>assets/js/Picker.js" type="text/javascript"></script>
        <script src="<?=WSystem::$url?>assets/js/Picker.Attach.js" type="text/javascript"></script>
        <script src="<?=WSystem::$url?>assets/js/Picker.Date.js" type="text/javascript"></script>  
        <script src="<?=WSystem::$url?>assets/js/jquery.hoverscroll.js" type="text/javascript"></script> 
        <script src="<?=WSystem::$url?>assets/js/jquery.zweatherfeed.min.js" type="text/javascript"></script> 
        <script src="<?=WSystem::$url?>assets/js/functions.js" type="text/javascript"></script> 
        <script type="text/javascript">
            var urlLogin = '<?=WSystem::$url?>login'; 
            var urlRentView = '<?=WSystem::$url?>rent/view/';
        </script> 

        <script type="text/javascript">

            $(document).ready(function(){
                    $('#weather-content').weatherfeed(['873915'],{
                            woeid: true
                    });

                    $.fn.hoverscroll.params = $.extend($.fn.hoverscroll.params, {
                            vertical : false,
                            width: 980,
                            height: 270,
                            arrows: false
                    });
                    $('#horizontal-scooters-1').hoverscroll();
                    $('#horizontal-scooters-2').hoverscroll();

                    document.getElementById("input-label-return").checked = true;
                    document.getElementById("inputs-label-return").style.display = "none"; 

                    window.addEvent('domready', function(){
                            new Picker.Date($$('#start-date'), {
                                    timePicker: true,
                                    positionOffset: {x: 5, y: 0},
                                    pickerClass: 'datepicker_bootstrap',
                                    useFadeInOut: !Browser.ie
                            });
                    });

                    window.addEvent('domready', function(){                
                            new Picker.Date($$('#end-date'), {
                                    timePicker: true,
                                    positionOffset: {x: 5, y: 0},
                                    pickerClass: 'datepicker_bootstrap',
                                    useFadeInOut: !Browser.ie
                            });
                    });

                    $("#members-area").mouseover(function() {
                            $("#members-area-content").show();
                            $("#weather-content").hide();
                            $("#currency-content").hide();
                    }).mouseout(function(){
                            $("#members-area-content").mouseenter(function() {
                                    $("#members-area-content").show(); 
                            }).mouseleave(function() {
                                    $("#members-area-content").hide();
                            });        
                    });

                    $("#weather").mouseover(function() {
                            $("#members-area-content").hide();
                            $("#weather-content").show();
                            $("#currency-content").hide();
                    }).mouseout(function(){
                            $("#weather-content").mouseenter(function() {
                                    $("#weather-content").show(); 
                            }).mouseleave(function() {
                                    $("#weather-content").hide();
                            });        
                    });  

                    $("#currency").mouseover(function() {
                            $("#members-area-content").hide();
                            $("#currency-content").show();
                            $("#weather-content").hide();
                    }).mouseout(function(){
                            $("#currency-content").mouseenter(function() {
                                    $("#currency-content").show(); 
                            }).mouseleave(function() {
                                    $("#currency-content").hide();
                            });        
                    });  


            }); 
            function showReturnLocationInputs(input){
                if(input.checked){
                    input.checked = true;
                    document.getElementById("inputs-label-return").style.display = "none";
                    $("#scooter-recomandation h2").css({ position: "relative", marginBottom: "", clear: "" });
                    $(".listcontainer").css({ position: "absolute" });
                    $("#scooter-feed").css({ height: "100%" });
                }else{
                    input.checked = false;
                    $("#scooter-recomandation h2").css({ position: "static",clear: "both" });
                    $(".listcontainer").css({ position: "relative", float: "left" });
                    $("#scooter-feed").css({ height: "320px" });
                    document.getElementById("inputs-label-return").style.display = "block";
                }
            }                    
            
        </script>              
    </body>
</html>
