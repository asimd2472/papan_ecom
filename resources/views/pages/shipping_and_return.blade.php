@extends('layouts.app')
@section('content')

<section class="productListBanner" style="background: url({{ Vite::asset('resources/front/images/pro-single-banner.jpg')}}) center center no-repeat">
    <svg
        class="waves"
        xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink"
        viewBox="0 24 150 28"
        preserveAspectRatio="none"
        shape-rendering="auto"
    >
        <defs>
            <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
        </defs>
        <g class="parallax">
            <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
            <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
            <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
            <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
        </g>
    </svg>
</section>

<section class="p-v-40 relative">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="privacyPolicy">
                    <h2>SHIPPING & RETURN POLICY</h2>
                    <h3>RETURNS / SHIPPING</h3>
                    <p>
                        At Drago Custom Rods, There are NO returns on “custom” build rod/s. Returns are only accepted on our “stock” Drago rods. We are not responsible for
                        shipping charges. Local pickup is welcome, just call us in advance to arrange a time. Shipping within the USA is $60, that includes PVC pipe, bubble
                        wrap, and shipping fees. Insurance is extra! Rod/s over 8 feet are pickup only since shipping is very expensive on oversize length rod/s.
                    </p>
                    <h3>WARRANTY</h3>
                    <p>
                        Drago Custom Rods are covered by a limited 2 year warranty against defects in workmanship only. Components and materials are covered by the
                        manufacturer.
                    </p>
                    <p>Drago Custom Rods will inspect the rod to determine the cause of damage.</p>
                    <ul>
                        <p>For damage determined to have occurred due to defect, Drago Custom Rods will, at the company’s discretion, either repair or
                            replace the product at no charge. Return shipping and handling is $60.
                        </p>
                        <p>
                            Damages occurring due to neglect, accident, or normal wear and tear will, at the company’s discretion, be repaired or replaced for
                            a specific fee.
                        </p>
                        <p>A full estimate will be provided for your approval before any fees are levied.</p>
                    </ul>
                    <h3>WARRANTY EXCLUSIONS</h3>
                    <p>This warranty does not cover:</p>
                    <ul>
                        <p>
                            Damage resulting from causes other than defects in materials and workmanship, including but not limited to accident, abuse,
                            misuse, neglect, improper assembly, improper repair, improper maintenance, alteration, modification, or other abnormal, excessive, or improper
                            use.
                        </p>
                        <p>
                            Damage resulting from normal wear and tear, including but not limited to damage or deterioration to the surface finish,
                            aesthetics, or appearance of the rod. (i.e. cork or foam material)
                        </p>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
