<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Invoice Payload Preview</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen p-8">
  <div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow">
    <h2 class="text-2xl font-semibold mb-4">Payload Preview</h2>
    <pre class="bg-gray-100 p-4 rounded overflow-auto">{{ json_encode($payload, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE) }}</pre>

    <div class="mt-4 flex space-x-3">
      <a href="{{ route('invoice.create') }}" class="px-4 py-2 rounded bg-gray-200">Back</a>
      <!-- If you want to save product details to DB via an API, add a form/button here -->
    </div>
  </div>
</body>
</html>
