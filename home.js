                                        function init() { 
                                            const catWrapper = document.querySelector('.cat_wrapper')
                                            const wrapper = document.querySelector('.wrapper')
                                            const cat = document.querySelector('.cat')
                                            const head = document.querySelector('.cat_head')
                                            const legs = document.querySelectorAll('.leg')
                                            const pos = {
                                              x: null,
                                              y: null
                                            }
                                          
                                            const walk = () =>{
                                              cat.classList.remove('first_pose')
                                              legs.forEach(leg=>leg.classList.add('walk'))
                                            }
                                          
                                            const handleMouseMotion = e =>{
                                              pos.x = e.clientX
                                              pos.y = e.clientY
                                              walk()
                                            }
                                          
                                            const handleTouchMotion = e =>{
                                              if (e.targetTouches) return
                                              
                                              pos.x = e.targetTouches[0].offsetX
                                              pos.y = e.targetTouches[0].offsetY
                                              walk()
                                            }
                                          
                                            const turnRight = () =>{
                                              cat.style.left = `${pos.x - 90}px`
                                              cat.classList.remove('face_left')
                                              cat.classList.add('face_right')
                                            }
                                          
                                            const turnLeft = () =>{
                                              cat.style.left = `${pos.x + 10}px`
                                              cat.classList.remove('face_right')
                                              cat.classList.add('face_left')
                                            }
                                          
                                            const decideTurnDirection = () =>{
                                              cat.getBoundingClientRect().x < pos.x ?
                                                turnRight()
                                                :
                                                turnLeft()
                                            }
                                          
                                            const headMotion = () =>{
                                              pos.y > (wrapper.clientHeight - 100) ?
                                                head.style.top = '-15px'
                                                :
                                                head.style.top = '-30px'
                                            }
                                          
                                            const jump = () =>{
                                              catWrapper.classList.remove('jump')
                                              if (pos.y < (wrapper.clientHeight - 250)) {
                                                setTimeout(()=>{
                                                  catWrapper.classList.add('jump')
                                                },100)
                                              } 
                                            }
                                          
                                            const decideStop = ()=>{
                                              if (cat.classList.contains('face_right') && pos.x - 90 === cat.offsetLeft ||
                                                  cat.classList.contains('face_left') && pos.x + 10 === cat.offsetLeft) {
                                                legs.forEach(leg=>leg.classList.remove('walk'))    
                                              }
                                            }
                                            
                                            setInterval(()=>{
                                              if (!pos.x || !pos.y) return
                                              decideTurnDirection()
                                              headMotion()
                                              decideStop()
                                            },100)
                                          
                                            setInterval(()=>{
                                              if (!pos.x || !pos.y) return
                                              jump()
                                            },1000)
                                          
                                            document.addEventListener('mousemove', handleMouseMotion)
                                            document.addEventListener('mousemove', handleTouchMotion)
                                          }
                                          
                                          window.addEventListener('DOMContentLoaded', init)

             // jumping dog

                          // loader starts 
                                        
                                            // Hide splash screen and show home page after 5 seconds
                                            setTimeout(() => {
                                                document.getElementById('splash').style.display = 'none';
                                                document.getElementById('home').style.display = 'block';
                                              }, 2500);
                                          
                            // loader ends







                                        $(document).ready(function () {
                                            $('.fa-bars').click(function () {
                                                $('.nav-links').slideToggle(3000);
                                            })
                                        })

                                        $(window).scroll(function () {
                                            let scroll = $(window).scrollTop();
                                            let width = $(window).width()
                                        


                                            if (scroll >= 70 && width >= 995) {
                                                $('nav').addClass("new-nav");

                                                $('nav ul li a').css({"color":"black"})

                                                $('.nav-heading span').css({"color":"black"})
                                                $('.nav-heading span>i').css({"color":"#F85A40"})
                                                $('.fa-moon').css({"color":"black"})



                                                // $('nav ul li a').css({"color": "black"})

                                                // $('.nav-heading span').css({"color":"black"})
                                                // $('.nav-heading span>i').css({"color":"#F85A40"})

                                              
                                              
                                            
                                            }

                                            else if (scroll==0 && width >= 995){
                                                $('nav').removeClass("new-nav");
                                                $('nav ul li a').css({"color":"#fff"})
                                                $('.nav-heading span>i').css({"color":"#fff"})
                                              

                                                $('.nav-heading span').css({"color":"white"})

                                                $('.fa-moon').css({"color":"#fff"})
                                                // $('nav ul li a').css({"color": "#fff"})

                                                // $('.nav-heading span').css({"color":"#fff"})
                                                // $('.nav-heading span>i').css({"color":"#fff"})

                                            }
                                            else if(scroll>=70 && width<995){
                                                $('.nav-heading span').css({"color":"black"})
                                                $('nav').addClass("new-nav");
                                                $('.nav-heading span').addClass("black")
                                                $('.nav-heading span>i').css({"color":"#F85A40"})
                                                $('.fa-moon').css({"color":"black"})

                                            }

                                            else if(scroll ==0 && width < 995 ){
                                                $('nav').removeClass("new-nav");
                                                $('.nav-heading span').css({"color":"white"})
                                                $('.nav-heading span').removeClass("black")
                                                $('.fa-moon').css({"color":"white"})

                                                $('.nav-links>span>i').css({"color":"#fff"})

                                            }
                                        })

                                        









                
 // navbar starts 
             //   navbar starts
                         // Login functionality
                         function login() {
                          alert('Redirecting to login page...');
                      }

                      // Sign-Up functionality
                      function signup() {
                          alert('Redirecting to sign-up page...');
                      }

                      // Simulate adding items to cart
                      let cartCount = 0;

                      function addToCart(itemName = "Default Item") {
                          cartCount++;
                          document.querySelector('.cart-countnew').textContent = cartCount;

                          // Append new item to the cart list
                          const cartList = document.querySelector('#cart-list');
                          const newItem = document.createElement('li');
                          newItem.textContent = `${itemName} added to cart`;
                          cartList.appendChild(newItem);
                      }

                      // Example: Simulate adding an item after 3 seconds
                      setTimeout(() => addToCart("Example Item"), 3000);
// navbar ends                 
              
// navbar ends
