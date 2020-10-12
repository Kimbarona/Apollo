FusionCharts.ready(function() {
     
    $.ajax({
        type: "POST",
        url: "GanttSetUp.php",
        dataType: "json",
        success: function (response) {
          console.log(response['arrayWeekly']);
         
        var chart = new FusionCharts({
            type: 'gantt',
            renderAt: 'chart-container',
            width: '1300',
            height: '600',
            dataFormat: 'json',
            dataSource: {
              "chart": {
                "caption": "",
                "subcaption": "",
                "dateformat": "yyyy/mm/dd",
                "outputdateformat": "ddds mns yy",
                "ganttwidthpercent": "50",
                "ganttPaneDuration": "80",
                "ganttPaneDurationUnit": "d",
                "plottooltext": "$processName{br} $label starting date $start{br}$label ending date $end",
                "theme": "fusion"
              },
              "categories": [{
                  "bgcolor": "#33bdda",
                  "category": [{
                    "start": response['StartDate'],
                    "end": response['EndDate'],
                    "label": "Months",
                    "align": "middle",
                    "fontcolor": "#1288dd",
                    "fontsize": "12"
                  }]
                },
                {
                  "bgcolor": "#33bdda",
                  "align": "middle",
                  "fontcolor": "#ffffff",
                  "fontsize": "16",
                  "category": response['arrayRangeYear']
                },
                {
                  "bgcolor": "#ffffff",
                  "fontcolor": "#1288dd",
                  "fontsize": "30",
                  "isbold": "2",
                  "align": "center",
                  "category": response['arrayWeekly']
                }
              ],
              "processes": {
                "headertext": "Work Description",
                "fontcolor": "#000000",
                "fontsize": "12",
                "isanimated": "1",
                "bgcolor": "purple",
                "headervalign": "bottom",
                "headeralign": "center",
                "headerbgcolor": "#6baa01",
                "headerfontcolor": "#ffffff",
                "headerfontsize": "15",
                "align": "center",
                "isbold": "1",
                "bgalpha": "15",
                "width": "140",
                
                
                "process": response['scope']
                
              },
              "datatable": {
                "showprocessname": "1",
                "namealign": "left",
                "fontcolor": "#000000",
                "fontsize": "12",
                "valign": "right",
                "align": "center",
                "headervalign": "bottom",
                "headeralign": "center",
                "headerbgcolor": "#008ee4",
                "headerfontcolor": "#ffffff",
                "headerfontsize": "12",
                "datacolumn": [{
                    "bgcolor": "#eeeeee",
                    "headertext": "Actual Start Date",
                    "text": response['PlanStartActualEnd']
                  },
                  {
                    "bgcolor": "#eeeeee",
                    "headertext": "Actual End Date",
                    "text": response['somePlanEndActualEnd']
                  }
                ]
              },
              "tasks": {
                "task": response['taskPlan']
              },
    
              "connectors": [{
                "connector": [{
                    "fromtaskid": "1",
                    "totaskid": "2",
                    "color": "#008ee4",
                    "thickness": "2",
                    "fromtaskconnectstart_": "1"
                  },
                  {
                    "fromtaskid": "2-2",
                    "totaskid": "3",
                    "color": "#008ee4",
                    "thickness": "2"
                  },
                  {
                    "fromtaskid": "3-2",
                    "totaskid": "4",
                    "color": "#008ee4",
                    "thickness": "2"
                  },
                  {
                    "fromtaskid": "3-2",
                    "totaskid": "6",
                    "color": "#008ee4",
                    "thickness": "2"
                  },
                  {
                    "fromtaskid": "7",
                    "totaskid": "8",
                    "color": "#008ee4",
                    "thickness": "2"
                  },
                  {
                    "fromtaskid": "7",
                    "totaskid": "9",
                    "color": "#008ee4",
                    "thickness": "2"
                  },
                  {
                    "fromtaskid": "12",
                    "totaskid": "16",
                    "color": "#008ee4",
                    "thickness": "2"
                  },
                  {
                    "fromtaskid": "12",
                    "totaskid": "17",
                    "color": "#008ee4",
                    "thickness": "2"
                  },
                  {
                    "fromtaskid": "17-2",
                    "totaskid": "18",
                    "color": "#008ee4",
                    "thickness": "2"
                  },
                  {
                    "fromtaskid": "19",
                    "totaskid": "22",
                    "color": "#008ee4",
                    "thickness": "2"
                  }
                ]
              }],
              "milestones": {
                "milestone": [{
                    // "date": "2/6/2019",
                    // "taskid": "12",
                    // "color": "#f8bd19",
                    // "shape": "star",
                    // "tooltext": "Completion of Phase 1"
                  }
                  /*{
                      "date": "21/8/2008",
                      "taskid": "10",
                      "color": "#f8bd19",
                      "shape": "star",
                      "tooltext": "New estimated moving date"
                  }*/
                ]
              },
              "legend": {
                "item": [{
                    "label": "Planned",
                    "color": "#008ee4"
                  },
                  {
                    "label": "Actual",
                    "color": "#6baa01"
                  },
                  {
                    "label": "Slack (Delay)",
                    "color": "#e44a00"
                  }
                ]
              }
            }
          })
          .render();
        }
      
      });
      });
        
    