<!DOCTYPE html>
<html>

<head>
    <title>Signature Pad</title>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.5/dist/signature_pad.umd.min.js"></script>
    <style>
        #signature-pad {
            border: 2px solid #000;
            /* width: 400px; */
            /* height: 200px; */
        }
    </style>
</head>

<body>
    <h2>Silakan Tanda Tangan di Bawah</h2>

    <form method="POST" action="{{ route('signature.save') }}">
        @csrf
        <canvas id="signature-pad"></canvas>
        <input type="hidden" name="signature" id="signature-input">
        <br>
        <button type="button" onclick="clearSignature()">Clear</button>
        <button type="submit" onclick="saveSignature()">Submit</button>
    </form>

    <script>
        const canvas = document.getElementById('signature-pad');
        const signaturePad = new SignaturePad(canvas);

        function saveSignature() {
            if (!signaturePad.isEmpty()) {
                const dataURL = signaturePad.toDataURL(); // Base64 PNG
                document.getElementById('signature-input').value = dataURL;
            } else {
                alert("Silakan tanda tangan terlebih dahulu.");
            }
        }

        function clearSignature() {
            signaturePad.clear();
        }
    </script>
</body>

</html>
