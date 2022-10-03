<div class="footer-dark">
    <footer>
        <div class="container">
            <div class="row">
            <div class="col-md-6 item text">
                    <h3>Devs Community</h3>
                    @if($langue == 'ar')
                        <p>منصة لتبادل المعلومات والأفكار حول علوم الكمبيوتر أيضًا لطرح أسئلة للإجابة عليها من قبل أشخاص آخرين ، أيضًا من خلال هذه المنصة يمكنك العثور على أو وضع مصادر للتعلم ومساعدة الناس الآخرين.</p>
                    @else
                        <p>Platform for sharing information and thoughts about computer science domain also for putting up questions for answer it by other poeple, also by this Platform you can find or put a ressources to learning and help other poeple.</p>
                    @endif
                </div>
                
                <div class="col-sm-6 col-md-3 link">
                @if($langue == 'ar')
                    <h3>الصفحات</h3>
                    <ul>
                        <li><a href="#">المنشورات</a></li>
                        <li><a href="#">الاسئلة</a></li>
                        <li><a href="#">المصادر</a></li>
                    </ul>
                @else
                    <h3>Pages</h3>
                    <ul>
                        <li><a href="#">posts</a></li>
                        <li><a href="#">questions</a></li>
                        <li><a href="#">ressources</a></li>
                    </ul>
                @endif
                </div>
                <div class="col-sm-6 col-md-3 contact">
                @if($langue == 'ar')
                    <h3>راسلنا</h3>
                @else
                    <h3>Contact us</h3>
                @endif
                <form>
                    <input type="text" class="form-control" @if($langue == 'ar')
                        placeholder="رسالتك"
                    @else
                        placeholder="Your message"
                    @endif />
                    <button class="btn" type="submit">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
                </div>
                {{-- <div class="col item social">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                </div> --}}
            </div>
            <p class="copyright">Devs Community © 2022</p>
            <p class="copyright">
                 @if($langue == 'ar')
                    من تطوير محسن ازلماط
                @else
                    Developed by Mouhcine azelmat
                @endif
            </p>
        </div>
    </footer>
</div>