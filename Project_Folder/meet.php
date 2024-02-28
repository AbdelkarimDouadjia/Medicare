<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Stream</title>
	<link rel="stylesheet" href="css/main.css">
</head>
<body>
	<button id="join-btn" clicked>Join meet</button>

	<div id="stream-wrapper">
		<div id="video-streams"></div>

		<div id="stream-controls">
			<button id="leave-btn">Leave meet</button>
			<button id="mic-btn">Mic On</button>
			<button id="camera-btn">Camera on</button>
		</div>
	</div>


	<script src="./js/AgoraRTC_N-4.7.3.js"></script>
	<script src="./js/main.js"></script>
	
</body>
</html>