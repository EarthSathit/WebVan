// jQuery Document
function alert_success(data){
	$("#alertbox").append('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="glyphicon glyphicon-ok"></span><strong>Heads up!</strong> '+data+'.</div>');
	$(".alert-success").fadeOut(15000);
}
function alert_info(data){
	$("#alertbox").append('<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="glyphicon glyphicon-info-sign"></span><strong>Well done!</strong> '+data+'.</div>');
	$(".alert-info").fadeOut(15000);
}
function alert_warning(data){
	$("#alertbox").append('<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="glyphicon glyphicon-warning-sign"></span><strong>Warning!</strong> '+data+'.</div>');
	$(".alert-warning").fadeOut(15000);
}
function alert_danger(data){
	$("#alertbox").append('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="glyphicon glyphicon-exclamation-sign"></span><strong> Danger!</strong> '+data+'.</div>');
	$(".alert-danger").fadeOut(15000);
}
