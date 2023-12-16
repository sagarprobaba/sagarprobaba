<div class="row">
    <!-- ***** FAQ Start ***** -->
    <div class="col-md-2"></div>

    @php
        $faqs = \App\Faq::all();
        $faqs_count = $faqs->count() / 2;
    @endphp

    <div class="col-md-8 offset-md-3">
        <div class="faq" id="accordion">

            @foreach ($faqs as $faq)

                <div class="card">
                    <div class="card-header" id="faqHeading-{{ $loop->iteration }}">
                        <div class="mb-0">
                            <h5 class="faq-title" data-toggle="collapse" data-target="#faqCollapse-{{ $loop->iteration }}"
                                data-aria-expanded="true" data-aria-controls="faqCollapse-{{ $loop->iteration }}"> <span
                                    class="badge">{{ $loop->iteration }}</span> {{ $faq->question }} </h5>
                        </div>
                    </div>
                    <div id="faqCollapse-{{ $loop->iteration }}" class="collapse" aria-labelledby="faqHeading-{{ $loop->iteration }}" data-parent="#accordion">
                        <div class="card-body">
                            <p>{{ $faq->answer }} </p>
                        </div>
                    </div>
                </div>
        
            @endforeach
           
        </div>
    </div>
</div>