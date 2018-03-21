<% if $SlideShow %>
    <div class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <% loop $SlideShow %>
                <div class="carousel-item <% if $First %>active<% end_if %>">
                    <% if $Link %><a href="$Link.LinkURL" title="$Link.Title"><% end_if %>
                    <img src="$Image.Fill(1200,600).URL" alt="<% if $Title %>$Title<% end_if %>">
                    <% if $Link %></a><% end_if %>

                    <div class="carousel-caption">
                        <% if $Title %><h2>$Title</h2><% end_if %>
                        <% if $Text %><p>$Text</p><% end_if %>
                        <% if $Link %>
                            <p>
                                <a href="$Link.LinkURL" title="$Link.Title.XML"><%t
                                    Twohill\Carousel\Extensions\Carousel.LEARN_MORE "Learn more" %></a>
                            </p>
                        <% end_if %>
                    </div>
                </div>
            <% end_loop %>
        </div>
    </div>
<% end_if %>
