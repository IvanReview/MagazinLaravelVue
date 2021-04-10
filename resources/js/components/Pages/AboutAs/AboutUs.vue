<template>
    <section class="about">
        <div class="container">
            <div class="row">
                <div class="about-main">
                    <h3 class="about-main__title">О нас</h3>
                    <div class="col s12 m12 l6">
                        <div class="about-main__iamge">
                            <img src="img/couples-2-04.png">
                        </div>
                    </div>
                    <div class="col s12 m12 l6">
                        <div class="about-main__text">
                            <div class="about-main__text-title">
                                Что у нас за Маназин?
                            </div>
                            <div class="about-main__text-desc">

                                <p>Genuine pleasure cigar, dynasty becoming respectable designer, noble status rare inspiring. Purebred cruise noble pedigree, yacht university suite. First-class, elegant panoramic symphony treasure with brilliant imported expensive inspiring five-star de-jour silver. Pearl cocktail topiary, world metropolitan.</p>

                                <p>Topiary de-jour gold high-rise architectural butler elegant presidential, society ladies pleasure tailored benefactor wishlist ballroom. Guests reserved grande opulent salon property inspiring topiary philanthropic gifted grande educated purebred affluent. Respectable blissfull ballroom de-jour portfolio ambassador.</p>

                                <p>Readymade marfa blog, pitchfork food truck tofu jean shorts homo organic photo booth scenester. Tytar terry richardson, biodiesel banksy food truck leggings high life gluten-free locavore american apparel freegan whatever photo booth. Brunch high life wes anderson trust fund, jean shorts mustache coffee butcher stumptown squid trust fund echo park. Four loko wes anderson readymade messenger bag, biodiesel stumptown twee craft beer mcsweeney’s raw denim brunch DIY irony.</p>

                            </div>

                            <div class="about-main__text-social">
                                <div class="about-main__text-social-desc">Социальные сети сети:</div>
                                <div>
                                    <span><a class="social__link" href=""> <i class="fab fa-instagram"></i></a></span>
                                    <span><a class="social__link" href=""> <i class="fab fa-twitter"></i></a></span>
                                    <span><a class="social__link" href=""> <i class="fab fa-vk"></i></a></span>
                                    <span><a class="social__link" href=""> <i class="fab fa-amazon"></i></a></span>
                                    <span><a class="social__link" href=""> <i class="fab fa-whatsapp"></i></a></span>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="about__services">
                    <div class="col s12 m6 l3">
                        <div class="card">
                            <div class="card-image">
                                <div class="about__services-icon"><i class="fas fa-blog"></i></div>
                            </div>
                            <div class="card-content">
                                <span class="card-title">Web Development</span>
                                <p class="card-text">Integer ac massa vehicula, viverra augue et, auctor urna. Morbi nec enim et odio 		blandit tempor vitae sit amet est. Aenean non fringilla lacus, ultricies mi.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col s12 m6 l3">
                        <div class="card">
                            <div class="card-image">
                                <div class="about__services-icon"><i class="fab fa-untappd"></i></div>
                            </div>
                            <div class="card-content">
                                <span class="card-title">Web Development</span>
                                <p class="card-text">Integer ac massa vehicula, viverra augue et, auctor urna. Morbi nec enim et odio 		blandit tempor vitae sit amet est. Aenean non fringilla lacus, ultricies mi.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col s12 m6 l3">
                        <div class="card">
                            <div class="card-image">
                                <div class="about__services-icon"><i class="far fa-envelope"></i></div>
                            </div>
                            <div class="card-content">
                                <span class="card-title">Web Development</span>
                                <p class="card-text">Integer ac massa vehicula, viverra augue et, auctor urna. Morbi nec enim et odio 		blandit tempor vitae sit amet est. Aenean non fringilla lacus, ultricies mi.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col s12 m6 l3">
                        <div class="card">
                            <div class="card-image">
                                <div class="about__services-icon"><i class="fas fa-chart-pie"></i></div>
                            </div>
                            <div class="card-content">
                                <span class="card-title">Web Development</span>
                                <p class="card-text">Integer ac massa vehicula, viverra augue et, auctor urna. Morbi nec enim et odio 		blandit tempor vitae sit amet est. Aenean non fringilla lacus, ultricies mi.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="about-team" style="display: flex; flex-direction: column;">

                    <h3 class="about-team__title">Наша Команда</h3>

                    <div class="our-team">
                        <div class="carousel carousel-slider">
                            <a class="carousel-item" href="#one!"><img src="/img/member-1.jpg">
                                <h5>Какой то Мужик</h5>
                                    <p class="dark-text">Менеджер</p>
                            </a>
                            <a class="carousel-item" href="#two!"><img src="/img/member-2.jpg">
                                <h5>Какая то Женщина</h5>
                                    <p class="dark-text">Дизайнер</p>
                            </a>
                            <a class="carousel-item" href="#three!"><img src="/img/member-3.jpg">
                                <h5>Какой то Мужик</h5>
                                    <p class="dark-text">Разработчик</p>
                            </a>
                            <a class="carousel-item" href="#four!"><img src="/img/member-7.jpg">
                                <h5>Какая то Женщина</h5>
                                    <p class="dark-text">CEO</p>
                            </a>
                            <a class="carousel-item" href="#five!"><img src="/img/member-5.jpg">
                                <h5>Какой то Мужик</h5>
                                    <p class="dark-text">Менеджер</p>
                            </a>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </section>

</template>

<script>
export default {
    name: "AboutUs",
    mounted() {
        M.AutoInit();
    }
}
</script>

<style scoped>


</style>
