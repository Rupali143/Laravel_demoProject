<html>
<head>
    <style>
        body.dragging, body.dragging * {
            cursor: move !important;
        }

        .dragged {
            position: absolute;
            opacity: 0.5;
            z-index: 2000;
        }

        ol.example li.placeholder {
            position: relative;
            /** More li styles **/
        }
        ol.example li.placeholder:before {
            position: absolute;
            /** Define arrowhead **/
        }
    </style>
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src='{{ asset('js/sortable.js') }}'></script>
    <script>

        $(function  () {
            $("ol.example").sortable();
        });</script>
</head>
<body>
<ol class='example'>
    <li>First</li>
    <li>Second</li>
    <li>Third</li>
</ol>
</body>
</html>
