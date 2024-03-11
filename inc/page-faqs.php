<div class="faqSection__list">
    <?php
        $faqs_list = SCF::get('faqs_list', 38);

        foreach ($faqs_list as $item) {
            ?>
            <div class="faqSection__item">
                <div class="faqSection__name">
                    <?php echo $item['faqs__name'] ?>
                    <div class="faqSection__toggle"></div>
                </div>
                <div class="faqSection__text"><?php echo $item['faqs__text'] ?></div>
            </div>
            <?php
        };
    ?>
</div>
<div class="faqSection__quest">
    <a href="#" class="btn btn_border" data-toggle="modal" data-target="#faqModal"><?php echo SCF::get( 'faqs__btn', 38 ); ?></a>
</div>

<!-- begin Modal faqModal -->
<div class="modal fade faqModal" id="faqModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <a href="#" class="modal-close" data-dismiss="modal"></a>
            <div class="modal-body">
                <?php echo do_shortcode( '[contact-form-7 id="141" title="Ask a Question"]' ); ?>
            </div>
        </div>
    </div>
</div>
<!-- end Modal faqModal -->
