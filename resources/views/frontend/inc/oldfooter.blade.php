

<!-- FOOTER -->
<footer id="footer" class="footer">
    <div class="footer-top d-none d-lg-block">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-5 col-xl-4 text-center text-md-left">
                    <div class="col">
                        <a href="/" class="d-block">
                            <img loading="lazy" src="{{ asset($settings['logo'] ?? '/logo.png') }}" alt="Quickbdbox"
                                height="44">
                        </a>
                        <p class="mt-3">{!! $settings['about'] ?? '' !!}</p>
                        <div class="d-inline-block d-md-block">
                            <form class="form-inline" method="POST" action="/subscribers">
                                <input type="hidden" name="_token" value="LrhTaq2yeau92NLlJPGm4tKTVxLdlb41XD8NKoFl">
                                <div class="form-group mb-0">
                                    <input type="email" class="form-control" placeholder="Your Email Address"
                                        name="email" required=""
                                        style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA3ZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDpiYmZkZTQxOS00ZGRkLWU5NDYtOWQ2MC05OGExNGJiMTA3N2YiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6RDAyNDkwMkRDOTIyMTFFNkI0MzFGRTk2RjM1OTdENTciIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6RDAyNDkwMkNDOTIyMTFFNkI0MzFGRTk2RjM1OTdENTciIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTUgKFdpbmRvd3MpIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6OTU2NTE1NDItMmIzOC1kZjRkLTk0N2UtN2NjOTlmMjQ5ZGFjIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOmJiZmRlNDE5LTRkZGQtZTk0Ni05ZDYwLTk4YTE0YmIxMDc3ZiIv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&quot;) !important; background-repeat: no-repeat; background-size: 20px; background-position: 97% center; cursor: auto;"
                                        data-temp-mail-org="0">
                                        <div class="input-group-append">
                                            <button type="submit" class=" btn btn-base-1 btn-icon-left">
                                                Subscribe
                                            </button>
                                          </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 offset-xl-1 col-md-4">
                    <div class="col text-center text-md-left">
                        <h4 class="heading heading-xs strong-600 text-uppercase mb-2">
                            Contact Info
                        </h4>
                        <ul class="footer-links contact-widget">
                            <li>
                                <span class="d-block opacity-5">Address:</span>
                                <span class="d-block">{{ $settings['address'] ?? '' }}</span>
                            </li>
                            <li>
                                <span class="d-block opacity-5">Phone:</span>
                                <span class="d-block">{{ $settings['phone'] ?? '' }}</span>
                            </li>
                            <li>
                                <span class="d-block opacity-5">Email:</span>
                                <span class="d-block">
                                    <a
                                        href="mailto:{{ $settings['contact_mail'] ?? '' }}">{{ $settings['contact_mail'] ?? '' }}</a>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <div class="col text-center text-md-left">
                        <h4 class="heading heading-xs strong-600 text-uppercase mb-2">
                            Useful Link
                        </h4>
                        <ul class="footer-links">
                            @forelse ($pages as $item)
                                
                            <li>
                                <a href="{{'page/'. $item->slug}}" title="{{ $item->title}}">
                                    {{ $item->title}}
                                </a>
                            </li>
                            @empty
                                
                            @endforelse
                           
                        </ul>
                    </div>
                </div>

                <div class="col-md-4 col-lg-2">
                    <div class="col text-center text-md-left">
                        <h4 class="heading heading-xs strong-600 text-uppercase mb-2">
                            My Account
                        </h4>

                        <ul class="footer-links">
                            <li>
                                <a href="/login" title="Login">
                                    Login
                                </a>
                            </li>
                            {{-- <li>
                                <a href="/purchase_history" title="Order History">
                                    Order History
                                </a>
                            </li> --}}
                            {{-- <li>
                                <a href="/wishlists" title="My Wishlist">
                                    My Wishlist
                                </a>
                            </li> --}}
                            <li>
                                <a href="/track_your_order" title="Track Order">
                                    Track Order
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom py-3 sct-color-3">
        <div class="container">
            <div class="row row-cols-xs-spaced flex flex-items-xs-middle">
                <div class="col-md-4">
                    <div class="copyright text-center text-md-left">
                        <ul class="copy-links no-margin d-md-none ">
                            <li>
                                © 2024 {{ $settings['app_name'] ?? 'nextgenbite' }}, Developed By <a href="http://nextgenbite.com">Nextgenbite</a>
                            </li>
                            
                            @forelse ($pages as $item)
                                
                            <li>
                                <a href="{{'page/'. $item->slug}}" title="{{ $item->title}}">
                                    {{ $item->title}}
                                </a>
                            </li>
                            @empty
                                
                            @endforelse
                        </ul>
                        <ul class="copy-links no-margin d-none d-lg-block">
                            <li>
                                © 2024 {{ $settings['app_name'] ?? 'nextgenbite' }}, Developed By <a href="http://nextgenbite.com" class="text-info">Nextgenbite</a>
                            </li>
                        
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="text-center my-3 my-md-0 social-nav model-2">
                        <li>
                            <a href="https://www.facebook.com/qbdbox" class="facebook" target="_blank" data-toggle="tooltip"
                                data-original-title="Facebook">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <div class="text-center text-md-right">
                        <ul class="inline-links">
                            <li>
                                <img loading="lazy" alt="sslcommerz"
                                    src="{{ asset('frontend/images/sslcommerz.png') }}" height="20">
                            </li>
                            <li>
                                <img loading="lazy" alt="cash on delivery"
                                    src="{{ asset('frontend/images/cod.png') }}" height="20">
                            </li>
                            <li>
                                <img loading="lazy" alt="bKash"
                                    src="{{ asset('frontend/images/tihCPJiSuxsCLbvtemea9Li4SrNIzXJLYPhWiv5d.png') }}"
                                    height="20">
                            </li>
                            <li>
                                <img loading="lazy" alt="Rocket"
                                    src="{{ asset('frontend/images/HBl192tABUqFchIblciU9vu8GlJI8dv1TU10WbaD.png') }}"
                                    height="20">
                            </li>
                            <li>
                                <img loading="lazy" alt="Nagat"
                                    src="{{ asset('frontend/images/xZs0mj6K5hHRPZZRcmMmOPr5q1jkApGz3uUYsJWq.jpeg') }}"
                                    height="20">
                            </li>
                            <li>
                                <img loading="lazy" alt="Dutch-Bangla Bank LTD"
                                    src="{{ asset('frontend/images/TmlE99476uzqdprUvttkAPlvH0cAGOjs0XH2MY70.jpeg') }}"
                                    height="20">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script>
    function confirm_modal(delete_url) {
        jQuery('#confirm-delete').modal('show', {
            backdrop: 'static'
        });
        document.getElementById('delete_link').setAttribute('href', delete_url);
    }
</script>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
            </div>

            <div class="modal-body">
                <p>Are you sure? (Note: All information relevant to this will be deleted too.)</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a id="delete_link" class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>

{{-- <div id="fb-root" class=" fb_reset"><div style="position: absolute; top: -10000px; width: 0px; height: 0px;"><div></div></div><div class="fb-customerchat" attribution="setup_tool" page_id="https://www.facebook.com/" fb-xfbml-state="rendered" fb-iframe-plugin-query="app_id=&amp;attribution=setup_tool&amp;current_url=https%3A%2F%2Fnobabieshop.com%2F&amp;is_loaded_by_facade=true&amp;locale=en_US&amp;log_id=93917acb-331b-454b-bc4d-83318035ea72&amp;page_id=https%3A%2F%2Fwww.facebook.com%2F&amp;request_time=1714134431848&amp;sdk=joey&amp;should_use_new_domain=false"><div id="f56ecf388f38efcef"><template shadowrootmode="closed"><style type="text/css" data-fbcssmodules="css:fb.shadow.css.chatdom">.container{box-shadow:0 4px 12px 0 rgba(0, 0, 0, .15);cursor:pointer}.label-container{align-items:center;display:flex}.label-container-icon{margin-left:-2px}.centered-container{align-items:center;display:flex;height:100%;justify-content:center;width:100%}.label-container-label{color:#fff;display:flex;font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;font-style:normal;font-weight:600;user-select:none;white-space:nowrap}@keyframes spin{from{transform:rotate(0deg)}to{transform:rotate(360deg)}}.spinning{animation:spin 2s linear infinite}.spinning .path{animation:dash 1.5s ease-in-out infinite;stroke:white;stroke-linecap:round}@keyframes dash{0%{stroke-dasharray:1, 150;stroke-dashoffset:0}50%{stroke-dasharray:90, 150;stroke-dashoffset:-56}100%{stroke-dasharray:90, 150;stroke-dashoffset:-149}}@keyframes slideInFromBottomDelay{0%{opacity:0;transform:translateY(100%)}90%{opacity:0;transform:translateY(100%)}100%{opacity:1;transform:translateY(0)}}</style><div class="container"></div></template></div></div><div class=" fb_iframe_widget fb_invisible_flow" fb-iframe-plugin-query="app_id=&amp;attribution=setup_tool&amp;container_width=1318&amp;current_url=https%3A%2F%2Fnobabieshop.com%2F&amp;is_loaded_by_facade=true&amp;locale=en_US&amp;log_id=93917acb-331b-454b-bc4d-83318035ea72&amp;page_id=https%3A%2F%2Fwww.facebook.com%2F&amp;request_time=1714134439860&amp;sdk=joey"><span style="vertical-align: top; width: 0px; height: 0px; overflow: hidden;"><iframe name="f9f96f26fbecc3d22" width="1000px" height="1000px" data-testid="fb:customerchat Facebook Social Plugin" title="" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media" src="{{asset('frontend/images/customerchat.html')}}" style="border: none; visibility: visible; width: 0px; height: 0px;"></iframe></span></div></div> --}}
<!-- Your customer chat code -->


<div class="modal fade" id="addToCart">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size"
        role="document">
        <div class="modal-content position-relative">
            <div class="c-preloader">
                <i class="fa fa-spin fa-spinner"></i>
            </div>
            <button type="button" class="close absolute-close-btn" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div id="addToCart-modal-body">

            </div>
        </div>
    </div>
</div>
