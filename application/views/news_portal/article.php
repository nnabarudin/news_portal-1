<?php include(VIEWPATH."_header.php") ?>
<div class="container-fluid">
    <div class="row">

        <div class="col-md-10 col-md-offset-1">

        </div>
        <div class="article_pdf">
            <div class="col-md-10 col-md-offset-1">
                <div class="page-header">
                    <h3><?php echo $article->title;?></h3>
                    <p class="help-block">Posted by: <?php echo  get_userdata($article->published_by)['name']." - ".get_userdata($article->published_by)['email'];?>
                    <button class='export-pdf btn btn-default btn-flat pull-right'><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Download as PDF</button>
                    <br/>
                    <span class="glyphicon glyphicon glyphicon-time" aria-hidden="true"></span> <?php echo $article->created_dtm;?></p>
                </div>
            </div>

            <div class="col-md-8 col-md-offset-2" >
                <img src="<?php echo base_url('uploads/'.$article->image);?>" alt="<?php echo $article->title; ?>" class="img-rounded"  style="max-height:330px;max-width:600px;" >
            </div>
            <div class="col-md-10 col-md-offset-1" >
                <br/>
                <p><?php echo $article->news_text;?></p>
            </div>

        </div>



    </div>
</div>

<script>
    // Import DejaVu Sans font for embedding

    // NOTE: Only required if the Kendo UI stylesheets are loaded
    // from a different origin, e.g. cdn.kendostatic.com
    kendo.pdf.defineFont({
        "DejaVu Sans"             : "//kendo.cdn.telerik.com/2014.3.1314/styles/fonts/DejaVu/DejaVuSans.ttf",
        "DejaVu Sans|Bold"        : "//kendo.cdn.telerik.com/2014.3.1314/styles/fonts/DejaVu/DejaVuSans-Bold.ttf",
        "DejaVu Sans|Bold|Italic" : "//kendo.cdn.telerik.com/2014.3.1314/styles/fonts/DejaVu/DejaVuSans-Oblique.ttf",
        "DejaVu Sans|Italic"      : "//kendo.cdn.telerik.com/2014.3.1314/styles/fonts/DejaVu/DejaVuSans-Oblique.ttf"
    });
</script>

<!-- Load Pako ZLIB library to enable PDF compression -->
<script src="<?php echo base_url();?>plugins/kendo-ui/js/pako_deflate.min.js"></script>
<script>
    $(document).ready(function() {

        $(".export-pdf").click(function() {
            // Convert the DOM element to a drawing using kendo.drawing.drawDOM
            kendo.drawing.drawDOM($(".article_pdf"))
                .then(function(group) {
                    // Render the result as a PDF file
                    return kendo.drawing.exportPDF(group, {
                        paperSize: "auto",
                        margin: { left: "1cm", top: "1cm", right: "1cm", bottom: "1cm" }
                    });
                })
                .done(function(data) {
                    // Save the PDF file
                    kendo.saveAs({
                        dataURI: data,
                        fileName: "article.pdf",
                        //proxyURL: "//demos.telerik.com/kendo-ui/service/export"
                    });
                });
        });
    });
</script>

<?php include(VIEWPATH."_footer.php") ?>
