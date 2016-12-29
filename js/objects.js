'use strict';

(function (window) {
	
	function CScreen ()
	{
		this.objectTypes = ko.observableArray([]);
		
		this.objectsList = ko.observableArray([]);
		this.propsList = ko.observableArray([]);
		
		this.selectedItem = ko.observable(null);
		this.selectedObjectName = ko.observable(null);
		this.checkedItems = ko.observableArray([]);
		
		this.switchTab = _.bind(this.switchTab, this);
		this.ajaxResponse = _.bind(this.ajaxResponse, this);
		this.selectItem = _.bind(this.selectItem, this);
		this.checkItem = _.bind(this.checkItem, this);
		
		this.postForm = _.bind(this.postForm, this);
		this.onPostResponse = _.bind(this.onPostResponse, this);
		
		this.init();
	}
	
	CScreen.prototype.init = function () {
		var 
			self = this
		;
		$.ajax({
			url: 'modules/EavObjectViewer/action.php',
			context: this,
			type: 'POST',
			data: {
				'action': 'types'
			},
			complete: self.ajaxTypesResponse,
			timeout: 1000
		});
	};
	
	CScreen.prototype.fillData = function (aData)
	{
		if (aData && aData.length > 0)
		{
			this.propsList(_.keys(aData[0]));
			this.objectsList(_.map(aData, function (oItem) {
				return _.values(oItem);
			}));
		}
		else
		{
			this.propsList([]);
			this.objectsList([]);
		}
	};
	
	CScreen.prototype.selectItem = function (oItem)
	{
		if (this.selectedItem() === oItem)
		{
			this.selectedItem(null);
			
			if (this.checkedItems().length === 1)
			{
				this.checkedItems([]);
			}
		}
		else
		{
			this.selectedItem(oItem);
			
			if (this.checkedItems().length === 0)
			{
				this.checkedItems.push(oItem[0]);
			}
			else if (this.checkedItems().length === 1)
			{
				this.checkedItems([oItem[0]]);
			}
		}
		
		return true;
	};
	
	CScreen.prototype.checkItem = function (oItem, oEvent)
	{
		oEvent.stopPropagation();

		if (_.contains(this.checkedItems(), oItem[0]))
		{
			this.checkedItems.remove(oItem[0]);
		}
		else
		{
			this.checkedItems.push(oItem[0]);
		}
		
		if (!this.selectedItem())
		{
			this.selectedItem(oItem);
		}
		
		return true;
	};
	
	CScreen.prototype.switchTab = function (sTabName)
	{
		var 
			self = this
		;
		
		this.selectedItem(null);
		this.checkedItems([]);
		this.selectedObjectName(sTabName);
		
		$.ajax({
			url: 'modules/EavObjectViewer/action.php',
			context: this,
			type: 'POST',
			data: {
				'action': 'list',
				'ObjectName': sTabName
			},
			complete: self.ajaxResponse,
			timeout: 1000
		});
	};
	
	CScreen.prototype.ajaxTypesResponse = function (jqXHR, textStatus) {
		if (textStatus === "success")
		{
			var oResponse = JSON.parse(jqXHR.responseText);
			this.objectTypes(oResponse.result);
		}
		else
		{
			console.log('ajaxResponse', textStatus);
		}
	};
	
	CScreen.prototype.ajaxResponse = function (jqXHR, textStatus) {
		if (textStatus === "success")
		{
			var oResponse = JSON.parse(jqXHR.responseText);
			this.fillData(oResponse.result);
		}
		else
		{
			console.log('ajaxResponse', textStatus);
		}
	};	
	
	CScreen.prototype.postForm = function (aItemData, oEvent)
	{
		var 
			self = this,
			oRequest = $(oEvent.currentTarget).closest('form').serialize()
		;

		$.ajax({
			url: 'modules/EavObjectViewer/action.php',
			context: this,
			type: 'POST',
			data: oRequest,
			complete: self.onPostResponse,
			timeout: 1000
		});
	};
	
	CScreen.prototype.onPostResponse = function (jqXHR, textStatus) {
		if (textStatus === "success")
		{
			this.switchTab(this.selectedObjectName());
		}
		else
		{
			console.log('ajaxResponse', textStatus);
		}
	};
	
	$(function () {
		ko.applyBindings(new CScreen(), document.getElementById('objects-screen'));
	});
})(window);


