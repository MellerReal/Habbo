$(window).load(function(){
console.log("  _    _       _     _               _    _ _______ __  __ _      _____      _____ __  __  _____ \n\
 | |  | |     | |   | |             | |  | |__   __|  \\/  | |    | ____|    / ____|  \\/  |/ ____|\n\
 | |__| | __ _| |__ | |__   ___     | |__| |  | |  | \\  / | |    | |__     | |    | \\  / | (___  \n\
 |  __  |/ _` | '_ \\| '_ \\ / _ \\    |  __  |  | |  | |\\/| | |    |___ \\    | |    | |\\/| |\\___ \ \n\
 | |  | | (_| | |_) | |_) | (_) |   | |  | |  | |  | |  | | |____ ___) |   | |____| |  | |____) |\n\
 |_|  |_|\\__,_|_.__/|_.__/ \\___/    |_|  |_|  |_|  |_|  |_|______|____/     \\_____|_|  |_|_____/");                           

	console.log("   > Launched the CMS.");

	console.log("   > Fixing margin positions..");
	var width = $(window).width()-1100;
	$("header").css("padding-right", " " + width/2 + "px");
	console.log("   > Generated and fixed positions to '" + width/2 + "px'.");

	$("input[name=cookies]").click(function(){
		console.log("   > Registered cookies click function.");
		$(".cookies").animate({
			bottom: "-56px"
		}, function(){
			$(".cookies").remove();
			console.log("   > Deleted cookies class.");
		});
	});

	var timer = setInterval(function(){
		clearInterval(timer);
		$("#remove").remove();
		console.log("   > Hiding <script> errors.");
	}, 100);
});