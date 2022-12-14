<style type="text/css">
	@keyframes lds-cube {
	0% {
		-webkit-transform: scale(1.5);
		transform: scale(1.5);
	}
	100% {
		-webkit-transform: scale(1);
		transform: scale(1);
	}
	}
	@-webkit-keyframes lds-cube {
	  0% {
		-webkit-transform: scale(1.5);
		transform: scale(1.5);
	  }
	  100% {
		-webkit-transform: scale(1);
		transform: scale(1);
	  }
	}
	.lds-cube {
	  position: fixed;
	  margin-left:40%;
	  z-index: 12;
	  
	}
	.lds-cube div {
	  position: absolute;
	  width: 80px;
	  height: 80px;
	  top: 10px;
	  left: 10px;
	  background: #ff727d;
	  -webkit-animation: lds-cube 1s cubic-bezier(0, 0.5, 0.5, 1) infinite;
	  animation: lds-cube 1s cubic-bezier(0, 0.5, 0.5, 1) infinite;
	  -webkit-animation-delay: -0.3s;
	  animation-delay: -0.3s;
	}
	.lds-cube div:nth-child(2) {
	  top: 10px;
	  left: 110px;
	  background: #ffd391;
	  -webkit-animation-delay: -0.2s;
	  animation-delay: -0.2s;
	}
	.lds-cube div:nth-child(3) {
	  top: 110px;
	  left: 110px;
	  background: #90ffb5;
	  -webkit-animation-delay: 0s;
	  animation-delay: 0s;
	}
	.lds-cube div:nth-child(4) {
	  top: 110px;
	  left: 10px;
	  background: #fffbd0;
	  -webkit-animation-delay: -0.1s;
	  animation-delay: -0.1s;
	}
	.lds-cube {
	  width: 200px !important;
	  height: 200px !important;
	  -webkit-transform: translate(-100px, -100px) scale(1) translate(100px, 100px);
	  transform: translate(-100px, -100px) scale(1) translate(100px, 100px);
	}
</style>
<div class="lds-css ng-scope class-loading-cube">
	<div style="width:100%;height:100%" class="lds-cube">
		<div>
		</div>
		<div>
		</div>
		<div>
		</div>
		<div>
		</div>
	</div>
</div>