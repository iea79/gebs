<!-- begin firstSection -->
<section id="firstSection" class="firstSection section">
    <div class="firstSection__bg">
        <div class="lotti" data-path="<?php echo wp_get_attachment_url(SCF::get( 'first__json' )); ?>" data-anim-loop="false" data-name="first__json"></div>
    </div>
    <div class="firstSection__video">
        <svg class="clipping-svg">
            <defs>
                <filter id="blur" x="0%" y="0%" width="100%" height="100%" color-interpolation-filters="sRGB">
                    <feGaussianBlur in="SourceGraphic" stdDeviation="3" />
                </filter>
                <clipPath id="clipping" clipPathUnits="objectBoundingBox" transform="scale(1) translate(0,0)">
                    <path d="M0.5850572916666666 0.1842143622722401C0.5841614583333333 0.18226473740621651 0.582796875 0.181550911039657 0.5815572916666666 0.18238156484458737C0.5803125 0.1832122186495177 0.5794166666666667 0.18543837084673098 0.5792447916666668 0.18810182207931403C0.5729062500000001 0.30704501607717044 0.5803020833333333 0.4519924973204716 0.609859375 0.5639142550911039C0.5810052083333334 0.527765273311897 0.5483281249999999 0.5065144694533762 0.5146197916666667 0.5019753483386924C0.5129765625 0.5021961414790996 0.5114927083333334 0.504075026795284 0.5106567708333334 0.506994640943194C0.5098203125 0.509914255091104 0.509740625 0.5134962486602358 0.5104427083333333 0.516561629153269C0.5315208333333333 0.5825369774919613 0.5624166666666667 0.642989281886388 0.59871875 0.6727491961414791C0.5844895833333333 0.6878992497320471 0.571796875 0.7084898177920685 0.5613177083333334 0.7334201500535905C0.5605364583333333 0.7354587352625938 0.5603489583333333 0.7382015005359056 0.5608229166666666 0.7406077170418006C0.5612916666666667 0.7430150053590567 0.5623541666666667 0.7447159699892819 0.5636041666666666 0.7450675241157556C0.5888697916666668 0.7571629153269025 0.6188072916666666 0.7548038585209003 0.6409583333333334 0.7239796355841371L0.6164375 0.8096141479099679C0.6145729166666667 0.8161103965702037 0.615625 0.824481243301179 0.61878125 0.8283097534833869C0.6219374999999999 0.8321382636655948 0.6260052083333334 0.8299753483386924 0.6278697916666667 0.8234790996784567L0.652390625 0.7378435155412647C0.6500520833333333 0.7925369774919614 0.6635208333333333 0.8476988210075027 0.6809010416666667 0.8873193997856378C0.68165625 0.8893987138263665 0.6828906250000001 0.8904876741693463 0.6841458333333333 0.8901725616291533C0.6853958333333333 0.8898563772775991 0.68646875 0.8881854233654877 0.6869583333333333 0.8857931404072884C0.6924947916666666 0.8548788853161843 0.6951197916666667 0.8220782422293677 0.6946927083333333 0.7891436227224008C0.7248333333333333 0.8401243301178992 0.7655364583333333 0.8663472668810289 0.8038489583333334 0.8723997856377277C0.8054947916666666 0.8721789924973206 0.8069791666666667 0.8703001071811362 0.8078125 0.8673804930332261C0.8086510416666666 0.8644608788853162 0.8087291666666666 0.8608788853161844 0.8080260416666667 0.8578135048231511C0.7897812500000001 0.7993644158628082 0.7649375 0.7508585209003216 0.7356145833333334 0.7164255091103965C0.7969583333333333 0.7152207931404073 0.8624635416666667 0.6588478027867096 0.9104947916666667 0.5898317256162915C0.9115468750000001 0.5882368703108254 0.9120572916666667 0.5855412647374062 0.9118072916666667 0.582903536977492C0.9115572916666667 0.5802668810289389 0.91059375 0.5781586280814577 0.9093333333333333 0.577486602357985C0.85009375 0.5506516613076099 0.7773125000000001 0.5514565916398714 0.71953125 0.6026227224008575L0.7192500000000001 0.6022765273311896C0.7770052083333333 0.4853097534833869 0.8102395833333333 0.30310289389067524 0.81940625 0.1414715969989282C0.8195677083333333 0.13882100750267953 0.8189479166666668 0.1362250803858521 0.8178333333333333 0.13486816720257233C0.8167135416666667 0.1335123258306538 0.8153072916666667 0.13365487674169346 0.8142604166666667 0.1352325830653805C0.7495989583333333 0.23114255091103966 0.6884895833333334 0.37890996784565917 0.6668906250000001 0.5387759914255091L0.6666041666666668 0.5384297963558414C0.6601250000000001 0.41044480171489817 0.6255520833333333 0.27865273311897104 0.5850572916666666 0.1842143622722401Z" />
                </clipPath>
            </defs>
        </svg>
        <video src="<?php echo wp_get_attachment_url(SCF::get( 'first__video' )) ?>" autoplay loop muted ?>"></video>
    </div>
    <div class="container_center">
        <div class="firstSection__content">
            <div class="firstSection__left">
                <h1 class="section__title"><?php echo SCF::get( 'first__title' ); ?></h1>
                <div class="section__sub"><?php echo SCF::get( 'first__text' ); ?></p>
                </div>
                <div class="firstSection__action">
                    <a href="<?php echo SCF::get( 'first__btn_link' ); ?>" class="btn btn_success">
                        <i class="icon_cart"></i>
                        <?php echo SCF::get( 'first__btn' ); ?>
                    </a>
                </div>
            </div>
            <div class="firstSection__right">
                <div class="firstSection__img">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end firstSection -->
<!-- begin perks -->
<section id="perks" class="perks section">
    <div class="container_center">
        <h2 class="section__title"><?php echo SCF::get( 'perks__title' ); ?></h2>
        <div class="section__sub"><?php echo SCF::get( 'perks__text' ); ?></div>
        <div class="perks__list">
            <?php
                $perks_section_list = SCF::get('perks_section_list');
                $i = 0;

                foreach ($perks_section_list as $item) {
                    ?>
                    <div class="perks__item">
                        <div class="perks__img">
                            <?php //echo wp_get_attachment_image($item['perks__img'], 'full') ?>
                            <div class="lotti" data-path="<?php echo wp_get_attachment_url($item[ 'perks__img' ]); ?>" data-anim-loop="false" data-name="perks__json<?php echo $i ?>"></div>
                        </div>
                        <div class="perks__text">
                            <?php echo $item['perks__name']; ?>
                        </div>
                    </div>
                    <?php
                    $i++;
                };
            ?>
        </div>
    </div>
</section>
<!-- end perks -->
<!-- begin productsSection -->
<section id="productsSection" class="productsSection section">
    <div class="productsSection__bg">
        <?php if (SCF::get( 'products__bg_json' )): ?>
            <div class="productsSection__json lotti" data-path="<?php echo wp_get_attachment_url(SCF::get( 'products__bg_json' )); ?>" data-anim-loop="false" data-name="products__bg_json"></div>
        <?php endif; ?>
        <?php echo wp_get_attachment_image(SCF::get( 'products__bg' ),'full') ?>
    </div>
    <div class="container_center">
        <div class="productsSection__top">
            <h2 class="section__title"><?php echo SCF::get( 'products__title' ); ?></h2>
            <div class="section__sub"><?php echo SCF::get( 'products__text' ); ?></div>
        </div>
        <div class="productsSection__points">
            <?php
                $products_section_points = SCF::get('products_section_points');

                foreach ($products_section_points as $item) {
                    ?>
                    <div class="productsSection__point">
                        <div class="productsSection__icon"><?php echo wp_get_attachment_image($item['products__img']) ?></div>
                        <div class="productsSection__descr"><?php echo $item['products__descr'] ?></div>
                    </div>
                    <?php
                };
            ?>
        </div>
        <div class="productsSection__products">
            <!-- <div class="productsSection__product">
            </div> -->
            <?php
                $homeProducts = SCF::get( 'products__list' );
                $ids = "";
                foreach ($homeProducts as $key => $value) {
                    $ids.=$value . ',';
                }
                echo do_shortcode( '[products ids='.$ids.']' );
            ?>
        </div>
        <div class="productsSection__more">
            <a href="/shop/" class="btn btn_border">
                <i class="icon_cart"></i>
                Shop now
            </a>
        </div>
    </div>
</section>
<!-- end productsSection -->

<!-- begin vsSection -->
<section id="vsSection" class="vsSection section">
    <div class="vsSection__bg">
        <?php echo wp_get_attachment_image(SCF::get( 'thc__bg' ),'full') ?>
    </div>
    <div class="container_center">
        <h2 class="section__title"><?php echo SCF::get( 'thc__title' ); ?></h2>
        <div class="vsSection__content">
            <div class="vsSection__item">
                <div class="vsSection__img">
                    <?php if (SCF::get( 'thc__json' )): ?>
                        <div class="lotti" data-path="<?php echo wp_get_attachment_url(SCF::get( 'thc__json' )); ?>" data-anim-loop="false" data-name="thc__json"></div>
                    <?php elseif (SCF::get( 'thc__img' )): ?>
                        <?php echo wp_get_attachment_image(SCF::get( 'thc__img' ),'full') ?>
                    <?php endif; ?>
                </div>
                <div class="vsSection__text"><?php echo SCF::get( 'thc__text' ); ?></div>
            </div>
            <div class="vsSection__item">
                <div class="vsSection__img">
                    <?php if (SCF::get( 'cbd__json' )): ?>
                        <div class="lotti" data-path="<?php echo wp_get_attachment_url(SCF::get( 'cbd__json' )); ?>" data-anim-loop="false" data-name="cbd__json"></div>
                    <?php elseif (SCF::get( 'cbd__img' )): ?>
                        <?php echo wp_get_attachment_image(SCF::get( 'cbd__img' ),'full') ?>
                    <?php endif; ?>
                </div>
                <div class="vsSection__text"><?php echo SCF::get( 'cbd__text' ); ?></div>
            </div>
        </div>
    </div>
</section>
<!-- end vsSection -->

<!-- begin cbdSection -->
<section id="cbdSection" class="cbdSection section">
    <div class="cbdSection__bg">
        <?php echo wp_get_attachment_image(SCF::get( 'cbd__bg' ),'full') ?>
    </div>
    <div class="container_center">
        <div class="cbdSection__content">
            <div class="cbdSection__left">
                <h2 class="section__title"><?php echo SCF::get( 'cbd__title' ); ?></h2>
                <div class="section__sub"><?php echo SCF::get( 'cbd__cub' ); ?></div>
                <div class="cbdSection__list"><?php echo SCF::get( 'cbd__list' ); ?></div>
            </div>
            <div class="cbdSection__right">
                <?php // echo wp_get_attachment_image(SCF::get( 'cbd__image' ),'full') ?>
                <div class="lotti" data-path="<?php echo wp_get_attachment_url(SCF::get( 'cbd__image' )); ?>" data-anim-loop="false" data-name="cbdSection__json"></div>
            </div>
        </div>
    </div>
</section>
<!-- end cbdSection -->

<!-- begin choiceSection -->
<section id="choiceSection" class="choiceSection section">
    <div class="choiceSection__bg">
        <?php if (SCF::get( 'choice__json' )): ?>
            <div class="choiceSection__json lotti" data-path="<?php echo wp_get_attachment_url(SCF::get( 'choice__json' )); ?>" data-anim-loop="false" data-name="choice__json"></div>
        <?php else: ?>
            <?php echo wp_get_attachment_image(SCF::get( 'choice__bg' ),'full') ?>
        <?php endif; ?>
    </div>
    <div class="container_center">
        <h2 class="section__title"><?php echo SCF::get( 'choice__title' ); ?></h2>
        <div class="section__sub"><?php echo SCF::get( 'choice__sub' ); ?></div>
        <div class="choiceSection__list">
            <?php
                $choice_list = SCF::get('choice_list');

                foreach ($choice_list as $item) {
                    ?>
                    <div class="choiceSection__item">
                        <div class="choiceSection__img">
                            <?php echo wp_get_attachment_image($item['choice__img'], 'full') ?>
                        </div>
                        <div class="choiceSection__name"><?php echo $item['choice__name'] ?></div>
                    </div>
                    <?php
                };
            ?>
        </div>
        <div class="choiceSection__text"><?php echo SCF::get( 'choice__text' ); ?></div>
    </div>
</section>
<!-- end choiceSection -->

<!-- begin faqSection -->
<section id="faqSection" class="faqSection section">
    <div class="container_center">
        <h2 class="section__title"><?php echo SCF::get( 'faqs__title' ); ?></h2>
        <?php require get_template_directory() . '/inc/page-faqs.php'; ?>
    </div>
</section>
<!-- end faqSection -->

<!-- begin readyToShop -->
<section id="readyToShop" class="readyToShop section">
    <div class="container_center">
        <div class="readyToShop__content">
            <div class="readyToShop__left">
                <h2 class="section__title"><?php echo SCF::get( 'ready__title' ); ?></h2>
                <div class="section__sub"><?php echo SCF::get( 'ready__sub' ); ?></div>
                <div class="readyToShop__link">
                    <a href="/shop/" class="btn btn_success">
                        <i class="icon_cart"></i>
                        Shop now
                    </a>
                </div>
            </div>
            <div class="readyToShop__right">
                <?php // echo wp_get_attachment_image(SCF::get( 'ready__image' ),'full') ?>
                <div class="lotti" data-path="<?php echo wp_get_attachment_url(SCF::get( 'ready__image' )); ?>" data-anim-loop="false" data-name="readyToShop__json"></div>
            </div>
        </div>
    </div>
</section>
<!-- end readyToShop -->
