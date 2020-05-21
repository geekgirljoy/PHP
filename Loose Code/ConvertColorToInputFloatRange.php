<?php 
// input a number between 0 and $max and get a number inside
// a range of -1 to 1
function ConvertColorToInputFloatRange($color_int_value, $max = 255){
    return ((($color_int_value - -1) * (1 - -1)) / ($max - 0)) + -1;
}

// Gray-scale / One Color channel 0-255
for ($i = 0; $i <= 255; $i += 1){
    echo  $i . ' = ' . ConvertColorToInputFloatRange($i) . PHP_EOL;
}

/*

0 = -0.9921568627451
1 = -0.9843137254902
2 = -0.97647058823529
3 = -0.96862745098039
4 = -0.96078431372549
5 = -0.95294117647059
6 = -0.94509803921569
7 = -0.93725490196078
8 = -0.92941176470588
9 = -0.92156862745098
10 = -0.91372549019608
11 = -0.90588235294118
12 = -0.89803921568627
13 = -0.89019607843137
14 = -0.88235294117647
15 = -0.87450980392157
16 = -0.86666666666667
17 = -0.85882352941176
18 = -0.85098039215686
19 = -0.84313725490196
20 = -0.83529411764706
21 = -0.82745098039216
22 = -0.81960784313725
23 = -0.81176470588235
24 = -0.80392156862745
25 = -0.79607843137255
26 = -0.78823529411765
27 = -0.78039215686275
28 = -0.77254901960784
29 = -0.76470588235294
30 = -0.75686274509804
31 = -0.74901960784314
32 = -0.74117647058824
33 = -0.73333333333333
34 = -0.72549019607843
35 = -0.71764705882353
36 = -0.70980392156863
37 = -0.70196078431373
38 = -0.69411764705882
39 = -0.68627450980392
40 = -0.67843137254902
41 = -0.67058823529412
42 = -0.66274509803922
43 = -0.65490196078431
44 = -0.64705882352941
45 = -0.63921568627451
46 = -0.63137254901961
47 = -0.62352941176471
48 = -0.6156862745098
49 = -0.6078431372549
50 = -0.6
51 = -0.5921568627451
52 = -0.5843137254902
53 = -0.57647058823529
54 = -0.56862745098039
55 = -0.56078431372549
56 = -0.55294117647059
57 = -0.54509803921569
58 = -0.53725490196078
59 = -0.52941176470588
60 = -0.52156862745098
61 = -0.51372549019608
62 = -0.50588235294118
63 = -0.49803921568627
64 = -0.49019607843137
65 = -0.48235294117647
66 = -0.47450980392157
67 = -0.46666666666667
68 = -0.45882352941176
69 = -0.45098039215686
70 = -0.44313725490196
71 = -0.43529411764706
72 = -0.42745098039216
73 = -0.41960784313725
74 = -0.41176470588235
75 = -0.40392156862745
76 = -0.39607843137255
77 = -0.38823529411765
78 = -0.38039215686275
79 = -0.37254901960784
80 = -0.36470588235294
81 = -0.35686274509804
82 = -0.34901960784314
83 = -0.34117647058824
84 = -0.33333333333333
85 = -0.32549019607843
86 = -0.31764705882353
87 = -0.30980392156863
88 = -0.30196078431373
89 = -0.29411764705882
90 = -0.28627450980392
91 = -0.27843137254902
92 = -0.27058823529412
93 = -0.26274509803922
94 = -0.25490196078431
95 = -0.24705882352941
96 = -0.23921568627451
97 = -0.23137254901961
98 = -0.22352941176471
99 = -0.2156862745098
100 = -0.2078431372549
101 = -0.2
102 = -0.1921568627451
103 = -0.1843137254902
104 = -0.17647058823529
105 = -0.16862745098039
106 = -0.16078431372549
107 = -0.15294117647059
108 = -0.14509803921569
109 = -0.13725490196078
110 = -0.12941176470588
111 = -0.12156862745098
112 = -0.11372549019608
113 = -0.10588235294118
114 = -0.098039215686274
115 = -0.090196078431373
116 = -0.082352941176471
117 = -0.074509803921569
118 = -0.066666666666667
119 = -0.058823529411765
120 = -0.050980392156863
121 = -0.043137254901961
122 = -0.035294117647059
123 = -0.027450980392157
124 = -0.019607843137255
125 = -0.011764705882353
126 = -0.003921568627451
127 = 0.003921568627451
128 = 0.011764705882353
129 = 0.019607843137255
130 = 0.027450980392157
131 = 0.035294117647059
132 = 0.043137254901961
133 = 0.050980392156863
134 = 0.058823529411765
135 = 0.066666666666667
136 = 0.074509803921569
137 = 0.082352941176471
138 = 0.090196078431372
139 = 0.098039215686275
140 = 0.10588235294118
141 = 0.11372549019608
142 = 0.12156862745098
143 = 0.12941176470588
144 = 0.13725490196078
145 = 0.14509803921569
146 = 0.15294117647059
147 = 0.16078431372549
148 = 0.16862745098039
149 = 0.17647058823529
150 = 0.1843137254902
151 = 0.1921568627451
152 = 0.2
153 = 0.2078431372549
154 = 0.2156862745098
155 = 0.22352941176471
156 = 0.23137254901961
157 = 0.23921568627451
158 = 0.24705882352941
159 = 0.25490196078431
160 = 0.26274509803922
161 = 0.27058823529412
162 = 0.27843137254902
163 = 0.28627450980392
164 = 0.29411764705882
165 = 0.30196078431373
166 = 0.30980392156863
167 = 0.31764705882353
168 = 0.32549019607843
169 = 0.33333333333333
170 = 0.34117647058824
171 = 0.34901960784314
172 = 0.35686274509804
173 = 0.36470588235294
174 = 0.37254901960784
175 = 0.38039215686275
176 = 0.38823529411765
177 = 0.39607843137255
178 = 0.40392156862745
179 = 0.41176470588235
180 = 0.41960784313725
181 = 0.42745098039216
182 = 0.43529411764706
183 = 0.44313725490196
184 = 0.45098039215686
185 = 0.45882352941176
186 = 0.46666666666667
187 = 0.47450980392157
188 = 0.48235294117647
189 = 0.49019607843137
190 = 0.49803921568627
191 = 0.50588235294118
192 = 0.51372549019608
193 = 0.52156862745098
194 = 0.52941176470588
195 = 0.53725490196078
196 = 0.54509803921569
197 = 0.55294117647059
198 = 0.56078431372549
199 = 0.56862745098039
200 = 0.57647058823529
201 = 0.5843137254902
202 = 0.5921568627451
203 = 0.6
204 = 0.6078431372549
205 = 0.6156862745098
206 = 0.62352941176471
207 = 0.63137254901961
208 = 0.63921568627451
209 = 0.64705882352941
210 = 0.65490196078431
211 = 0.66274509803922
212 = 0.67058823529412
213 = 0.67843137254902
214 = 0.68627450980392
215 = 0.69411764705882
216 = 0.70196078431373
217 = 0.70980392156863
218 = 0.71764705882353
219 = 0.72549019607843
220 = 0.73333333333333
221 = 0.74117647058824
222 = 0.74901960784314
223 = 0.75686274509804
224 = 0.76470588235294
225 = 0.77254901960784
226 = 0.78039215686274
227 = 0.78823529411765
228 = 0.79607843137255
229 = 0.80392156862745
230 = 0.81176470588235
231 = 0.81960784313725
232 = 0.82745098039216
233 = 0.83529411764706
234 = 0.84313725490196
235 = 0.85098039215686
236 = 0.85882352941176
237 = 0.86666666666667
238 = 0.87450980392157
239 = 0.88235294117647
240 = 0.89019607843137
241 = 0.89803921568627
242 = 0.90588235294118
243 = 0.91372549019608
244 = 0.92156862745098
245 = 0.92941176470588
246 = 0.93725490196078
247 = 0.94509803921569
248 = 0.95294117647059
249 = 0.96078431372549
250 = 0.96862745098039
251 = 0.97647058823529
252 = 0.9843137254902
253 = 0.9921568627451
254 = 1
255 = 1.0078431372549

*/


// Two Color Channels as Gray-scale 0-510
for ($i = 0; $i <= 510; $i += 1){
    echo  $i . ' = ' . ConvertColorToInputFloatRange($i, 255+255) . PHP_EOL;
}

/*

0 = -0.99607843137255
1 = -0.9921568627451
2 = -0.98823529411765
3 = -0.9843137254902
4 = -0.98039215686275
5 = -0.97647058823529
6 = -0.97254901960784
7 = -0.96862745098039
8 = -0.96470588235294
9 = -0.96078431372549
10 = -0.95686274509804
11 = -0.95294117647059
12 = -0.94901960784314
13 = -0.94509803921569
14 = -0.94117647058824
15 = -0.93725490196078
16 = -0.93333333333333
17 = -0.92941176470588
18 = -0.92549019607843
19 = -0.92156862745098
20 = -0.91764705882353
21 = -0.91372549019608
22 = -0.90980392156863
23 = -0.90588235294118
24 = -0.90196078431373
25 = -0.89803921568627
26 = -0.89411764705882
27 = -0.89019607843137
28 = -0.88627450980392
29 = -0.88235294117647
30 = -0.87843137254902
31 = -0.87450980392157
32 = -0.87058823529412
33 = -0.86666666666667
34 = -0.86274509803922
35 = -0.85882352941176
36 = -0.85490196078431
37 = -0.85098039215686
38 = -0.84705882352941
39 = -0.84313725490196
40 = -0.83921568627451
41 = -0.83529411764706
42 = -0.83137254901961
43 = -0.82745098039216
44 = -0.82352941176471
45 = -0.81960784313725
46 = -0.8156862745098
47 = -0.81176470588235
48 = -0.8078431372549
49 = -0.80392156862745
50 = -0.8
51 = -0.79607843137255
52 = -0.7921568627451
53 = -0.78823529411765
54 = -0.7843137254902
55 = -0.78039215686275
56 = -0.77647058823529
57 = -0.77254901960784
58 = -0.76862745098039
59 = -0.76470588235294
60 = -0.76078431372549
61 = -0.75686274509804
62 = -0.75294117647059
63 = -0.74901960784314
64 = -0.74509803921569
65 = -0.74117647058824
66 = -0.73725490196078
67 = -0.73333333333333
68 = -0.72941176470588
69 = -0.72549019607843
70 = -0.72156862745098
71 = -0.71764705882353
72 = -0.71372549019608
73 = -0.70980392156863
74 = -0.70588235294118
75 = -0.70196078431373
76 = -0.69803921568627
77 = -0.69411764705882
78 = -0.69019607843137
79 = -0.68627450980392
80 = -0.68235294117647
81 = -0.67843137254902
82 = -0.67450980392157
83 = -0.67058823529412
84 = -0.66666666666667
85 = -0.66274509803922
86 = -0.65882352941176
87 = -0.65490196078431
88 = -0.65098039215686
89 = -0.64705882352941
90 = -0.64313725490196
91 = -0.63921568627451
92 = -0.63529411764706
93 = -0.63137254901961
94 = -0.62745098039216
95 = -0.62352941176471
96 = -0.61960784313725
97 = -0.6156862745098
98 = -0.61176470588235
99 = -0.6078431372549
100 = -0.60392156862745
101 = -0.6
102 = -0.59607843137255
103 = -0.5921568627451
104 = -0.58823529411765
105 = -0.5843137254902
106 = -0.58039215686275
107 = -0.57647058823529
108 = -0.57254901960784
109 = -0.56862745098039
110 = -0.56470588235294
111 = -0.56078431372549
112 = -0.55686274509804
113 = -0.55294117647059
114 = -0.54901960784314
115 = -0.54509803921569
116 = -0.54117647058824
117 = -0.53725490196078
118 = -0.53333333333333
119 = -0.52941176470588
120 = -0.52549019607843
121 = -0.52156862745098
122 = -0.51764705882353
123 = -0.51372549019608
124 = -0.50980392156863
125 = -0.50588235294118
126 = -0.50196078431373
127 = -0.49803921568627
128 = -0.49411764705882
129 = -0.49019607843137
130 = -0.48627450980392
131 = -0.48235294117647
132 = -0.47843137254902
133 = -0.47450980392157
134 = -0.47058823529412
135 = -0.46666666666667
136 = -0.46274509803922
137 = -0.45882352941176
138 = -0.45490196078431
139 = -0.45098039215686
140 = -0.44705882352941
141 = -0.44313725490196
142 = -0.43921568627451
143 = -0.43529411764706
144 = -0.43137254901961
145 = -0.42745098039216
146 = -0.42352941176471
147 = -0.41960784313725
148 = -0.4156862745098
149 = -0.41176470588235
150 = -0.4078431372549
151 = -0.40392156862745
152 = -0.4
153 = -0.39607843137255
154 = -0.3921568627451
155 = -0.38823529411765
156 = -0.3843137254902
157 = -0.38039215686275
158 = -0.37647058823529
159 = -0.37254901960784
160 = -0.36862745098039
161 = -0.36470588235294
162 = -0.36078431372549
163 = -0.35686274509804
164 = -0.35294117647059
165 = -0.34901960784314
166 = -0.34509803921569
167 = -0.34117647058824
168 = -0.33725490196078
169 = -0.33333333333333
170 = -0.32941176470588
171 = -0.32549019607843
172 = -0.32156862745098
173 = -0.31764705882353
174 = -0.31372549019608
175 = -0.30980392156863
176 = -0.30588235294118
177 = -0.30196078431373
178 = -0.29803921568627
179 = -0.29411764705882
180 = -0.29019607843137
181 = -0.28627450980392
182 = -0.28235294117647
183 = -0.27843137254902
184 = -0.27450980392157
185 = -0.27058823529412
186 = -0.26666666666667
187 = -0.26274509803922
188 = -0.25882352941176
189 = -0.25490196078431
190 = -0.25098039215686
191 = -0.24705882352941
192 = -0.24313725490196
193 = -0.23921568627451
194 = -0.23529411764706
195 = -0.23137254901961
196 = -0.22745098039216
197 = -0.22352941176471
198 = -0.21960784313725
199 = -0.2156862745098
200 = -0.21176470588235
201 = -0.2078431372549
202 = -0.20392156862745
203 = -0.2
204 = -0.19607843137255
205 = -0.1921568627451
206 = -0.18823529411765
207 = -0.1843137254902
208 = -0.18039215686275
209 = -0.17647058823529
210 = -0.17254901960784
211 = -0.16862745098039
212 = -0.16470588235294
213 = -0.16078431372549
214 = -0.15686274509804
215 = -0.15294117647059
216 = -0.14901960784314
217 = -0.14509803921569
218 = -0.14117647058824
219 = -0.13725490196078
220 = -0.13333333333333
221 = -0.12941176470588
222 = -0.12549019607843
223 = -0.12156862745098
224 = -0.11764705882353
225 = -0.11372549019608
226 = -0.10980392156863
227 = -0.10588235294118
228 = -0.10196078431373
229 = -0.098039215686274
230 = -0.094117647058824
231 = -0.090196078431373
232 = -0.086274509803922
233 = -0.082352941176471
234 = -0.07843137254902
235 = -0.074509803921569
236 = -0.070588235294118
237 = -0.066666666666667
238 = -0.062745098039216
239 = -0.058823529411765
240 = -0.054901960784314
241 = -0.050980392156863
242 = -0.047058823529412
243 = -0.043137254901961
244 = -0.03921568627451
245 = -0.035294117647059
246 = -0.031372549019608
247 = -0.027450980392157
248 = -0.023529411764706
249 = -0.019607843137255
250 = -0.015686274509804
251 = -0.011764705882353
252 = -0.0078431372549019
253 = -0.003921568627451
254 = 0
255 = 0.003921568627451
256 = 0.0078431372549019
257 = 0.011764705882353
258 = 0.015686274509804
259 = 0.019607843137255
260 = 0.023529411764706
261 = 0.027450980392157
262 = 0.031372549019608
263 = 0.035294117647059
264 = 0.03921568627451
265 = 0.043137254901961
266 = 0.047058823529412
267 = 0.050980392156863
268 = 0.054901960784314
269 = 0.058823529411765
270 = 0.062745098039216
271 = 0.066666666666667
272 = 0.070588235294118
273 = 0.074509803921569
274 = 0.07843137254902
275 = 0.082352941176471
276 = 0.086274509803921
277 = 0.090196078431372
278 = 0.094117647058824
279 = 0.098039215686275
280 = 0.10196078431373
281 = 0.10588235294118
282 = 0.10980392156863
283 = 0.11372549019608
284 = 0.11764705882353
285 = 0.12156862745098
286 = 0.12549019607843
287 = 0.12941176470588
288 = 0.13333333333333
289 = 0.13725490196078
290 = 0.14117647058824
291 = 0.14509803921569
292 = 0.14901960784314
293 = 0.15294117647059
294 = 0.15686274509804
295 = 0.16078431372549
296 = 0.16470588235294
297 = 0.16862745098039
298 = 0.17254901960784
299 = 0.17647058823529
300 = 0.18039215686275
301 = 0.1843137254902
302 = 0.18823529411765
303 = 0.1921568627451
304 = 0.19607843137255
305 = 0.2
306 = 0.20392156862745
307 = 0.2078431372549
308 = 0.21176470588235
309 = 0.2156862745098
310 = 0.21960784313726
311 = 0.22352941176471
312 = 0.22745098039216
313 = 0.23137254901961
314 = 0.23529411764706
315 = 0.23921568627451
316 = 0.24313725490196
317 = 0.24705882352941
318 = 0.25098039215686
319 = 0.25490196078431
320 = 0.25882352941176
321 = 0.26274509803922
322 = 0.26666666666667
323 = 0.27058823529412
324 = 0.27450980392157
325 = 0.27843137254902
326 = 0.28235294117647
327 = 0.28627450980392
328 = 0.29019607843137
329 = 0.29411764705882
330 = 0.29803921568627
331 = 0.30196078431373
332 = 0.30588235294118
333 = 0.30980392156863
334 = 0.31372549019608
335 = 0.31764705882353
336 = 0.32156862745098
337 = 0.32549019607843
338 = 0.32941176470588
339 = 0.33333333333333
340 = 0.33725490196078
341 = 0.34117647058824
342 = 0.34509803921569
343 = 0.34901960784314
344 = 0.35294117647059
345 = 0.35686274509804
346 = 0.36078431372549
347 = 0.36470588235294
348 = 0.36862745098039
349 = 0.37254901960784
350 = 0.37647058823529
351 = 0.38039215686275
352 = 0.3843137254902
353 = 0.38823529411765
354 = 0.3921568627451
355 = 0.39607843137255
356 = 0.4
357 = 0.40392156862745
358 = 0.4078431372549
359 = 0.41176470588235
360 = 0.4156862745098
361 = 0.41960784313725
362 = 0.42352941176471
363 = 0.42745098039216
364 = 0.43137254901961
365 = 0.43529411764706
366 = 0.43921568627451
367 = 0.44313725490196
368 = 0.44705882352941
369 = 0.45098039215686
370 = 0.45490196078431
371 = 0.45882352941176
372 = 0.46274509803922
373 = 0.46666666666667
374 = 0.47058823529412
375 = 0.47450980392157
376 = 0.47843137254902
377 = 0.48235294117647
378 = 0.48627450980392
379 = 0.49019607843137
380 = 0.49411764705882
381 = 0.49803921568627
382 = 0.50196078431373
383 = 0.50588235294118
384 = 0.50980392156863
385 = 0.51372549019608
386 = 0.51764705882353
387 = 0.52156862745098
388 = 0.52549019607843
389 = 0.52941176470588
390 = 0.53333333333333
391 = 0.53725490196078
392 = 0.54117647058824
393 = 0.54509803921569
394 = 0.54901960784314
395 = 0.55294117647059
396 = 0.55686274509804
397 = 0.56078431372549
398 = 0.56470588235294
399 = 0.56862745098039
400 = 0.57254901960784
401 = 0.57647058823529
402 = 0.58039215686275
403 = 0.5843137254902
404 = 0.58823529411765
405 = 0.5921568627451
406 = 0.59607843137255
407 = 0.6
408 = 0.60392156862745
409 = 0.6078431372549
410 = 0.61176470588235
411 = 0.6156862745098
412 = 0.61960784313725
413 = 0.62352941176471
414 = 0.62745098039216
415 = 0.63137254901961
416 = 0.63529411764706
417 = 0.63921568627451
418 = 0.64313725490196
419 = 0.64705882352941
420 = 0.65098039215686
421 = 0.65490196078431
422 = 0.65882352941176
423 = 0.66274509803922
424 = 0.66666666666667
425 = 0.67058823529412
426 = 0.67450980392157
427 = 0.67843137254902
428 = 0.68235294117647
429 = 0.68627450980392
430 = 0.69019607843137
431 = 0.69411764705882
432 = 0.69803921568627
433 = 0.70196078431373
434 = 0.70588235294118
435 = 0.70980392156863
436 = 0.71372549019608
437 = 0.71764705882353
438 = 0.72156862745098
439 = 0.72549019607843
440 = 0.72941176470588
441 = 0.73333333333333
442 = 0.73725490196078
443 = 0.74117647058824
444 = 0.74509803921569
445 = 0.74901960784314
446 = 0.75294117647059
447 = 0.75686274509804
448 = 0.76078431372549
449 = 0.76470588235294
450 = 0.76862745098039
451 = 0.77254901960784
452 = 0.77647058823529
453 = 0.78039215686274
454 = 0.7843137254902
455 = 0.78823529411765
456 = 0.7921568627451
457 = 0.79607843137255
458 = 0.8
459 = 0.80392156862745
460 = 0.8078431372549
461 = 0.81176470588235
462 = 0.8156862745098
463 = 0.81960784313725
464 = 0.82352941176471
465 = 0.82745098039216
466 = 0.83137254901961
467 = 0.83529411764706
468 = 0.83921568627451
469 = 0.84313725490196
470 = 0.84705882352941
471 = 0.85098039215686
472 = 0.85490196078431
473 = 0.85882352941176
474 = 0.86274509803922
475 = 0.86666666666667
476 = 0.87058823529412
477 = 0.87450980392157
478 = 0.87843137254902
479 = 0.88235294117647
480 = 0.88627450980392
481 = 0.89019607843137
482 = 0.89411764705882
483 = 0.89803921568627
484 = 0.90196078431373
485 = 0.90588235294118
486 = 0.90980392156863
487 = 0.91372549019608
488 = 0.91764705882353
489 = 0.92156862745098
490 = 0.92549019607843
491 = 0.92941176470588
492 = 0.93333333333333
493 = 0.93725490196078
494 = 0.94117647058824
495 = 0.94509803921569
496 = 0.94901960784314
497 = 0.95294117647059
498 = 0.95686274509804
499 = 0.96078431372549
500 = 0.96470588235294
501 = 0.96862745098039
502 = 0.97254901960784
503 = 0.97647058823529
504 = 0.98039215686275
505 = 0.9843137254902
506 = 0.98823529411765
507 = 0.9921568627451
508 = 0.99607843137255
509 = 1
510 = 1.0039215686275

*/





// Three Color Channels as Gray-scale 0-765
for ($i = 0; $i <= 765; $i += 1){
    echo  $i . ' = ' . ConvertColorToInputFloatRange($i, 255+255+255) . PHP_EOL;
}

/*

0 = -0.99738562091503
1 = -0.99477124183007
2 = -0.9921568627451
3 = -0.98954248366013
4 = -0.98692810457516
5 = -0.9843137254902
6 = -0.98169934640523
7 = -0.97908496732026
8 = -0.97647058823529
9 = -0.97385620915033
10 = -0.97124183006536
11 = -0.96862745098039
12 = -0.96601307189542
13 = -0.96339869281046
14 = -0.96078431372549
15 = -0.95816993464052
16 = -0.95555555555556
17 = -0.95294117647059
18 = -0.95032679738562
19 = -0.94771241830065
20 = -0.94509803921569
21 = -0.94248366013072
22 = -0.93986928104575
23 = -0.93725490196078
24 = -0.93464052287582
25 = -0.93202614379085
26 = -0.92941176470588
27 = -0.92679738562092
28 = -0.92418300653595
29 = -0.92156862745098
30 = -0.91895424836601
31 = -0.91633986928105
32 = -0.91372549019608
33 = -0.91111111111111
34 = -0.90849673202614
35 = -0.90588235294118
36 = -0.90326797385621
37 = -0.90065359477124
38 = -0.89803921568627
39 = -0.89542483660131
40 = -0.89281045751634
41 = -0.89019607843137
42 = -0.88758169934641
43 = -0.88496732026144
44 = -0.88235294117647
45 = -0.8797385620915
46 = -0.87712418300654
47 = -0.87450980392157
48 = -0.8718954248366
49 = -0.86928104575163
50 = -0.86666666666667
51 = -0.8640522875817
52 = -0.86143790849673
53 = -0.85882352941176
54 = -0.8562091503268
55 = -0.85359477124183
56 = -0.85098039215686
57 = -0.8483660130719
58 = -0.84575163398693
59 = -0.84313725490196
60 = -0.84052287581699
61 = -0.83790849673203
62 = -0.83529411764706
63 = -0.83267973856209
64 = -0.83006535947712
65 = -0.82745098039216
66 = -0.82483660130719
67 = -0.82222222222222
68 = -0.81960784313725
69 = -0.81699346405229
70 = -0.81437908496732
71 = -0.81176470588235
72 = -0.80915032679739
73 = -0.80653594771242
74 = -0.80392156862745
75 = -0.80130718954248
76 = -0.79869281045752
77 = -0.79607843137255
78 = -0.79346405228758
79 = -0.79084967320261
80 = -0.78823529411765
81 = -0.78562091503268
82 = -0.78300653594771
83 = -0.78039215686275
84 = -0.77777777777778
85 = -0.77516339869281
86 = -0.77254901960784
87 = -0.76993464052288
88 = -0.76732026143791
89 = -0.76470588235294
90 = -0.76209150326797
91 = -0.75947712418301
92 = -0.75686274509804
93 = -0.75424836601307
94 = -0.7516339869281
95 = -0.74901960784314
96 = -0.74640522875817
97 = -0.7437908496732
98 = -0.74117647058824
99 = -0.73856209150327
100 = -0.7359477124183
101 = -0.73333333333333
102 = -0.73071895424837
103 = -0.7281045751634
104 = -0.72549019607843
105 = -0.72287581699346
106 = -0.7202614379085
107 = -0.71764705882353
108 = -0.71503267973856
109 = -0.71241830065359
110 = -0.70980392156863
111 = -0.70718954248366
112 = -0.70457516339869
113 = -0.70196078431373
114 = -0.69934640522876
115 = -0.69673202614379
116 = -0.69411764705882
117 = -0.69150326797386
118 = -0.68888888888889
119 = -0.68627450980392
120 = -0.68366013071895
121 = -0.68104575163399
122 = -0.67843137254902
123 = -0.67581699346405
124 = -0.67320261437909
125 = -0.67058823529412
126 = -0.66797385620915
127 = -0.66535947712418
128 = -0.66274509803922
129 = -0.66013071895425
130 = -0.65751633986928
131 = -0.65490196078431
132 = -0.65228758169935
133 = -0.64967320261438
134 = -0.64705882352941
135 = -0.64444444444444
136 = -0.64183006535948
137 = -0.63921568627451
138 = -0.63660130718954
139 = -0.63398692810458
140 = -0.63137254901961
141 = -0.62875816993464
142 = -0.62614379084967
143 = -0.62352941176471
144 = -0.62091503267974
145 = -0.61830065359477
146 = -0.6156862745098
147 = -0.61307189542484
148 = -0.61045751633987
149 = -0.6078431372549
150 = -0.60522875816993
151 = -0.60261437908497
152 = -0.6
153 = -0.59738562091503
154 = -0.59477124183007
155 = -0.5921568627451
156 = -0.58954248366013
157 = -0.58692810457516
158 = -0.5843137254902
159 = -0.58169934640523
160 = -0.57908496732026
161 = -0.57647058823529
162 = -0.57385620915033
163 = -0.57124183006536
164 = -0.56862745098039
165 = -0.56601307189542
166 = -0.56339869281046
167 = -0.56078431372549
168 = -0.55816993464052
169 = -0.55555555555556
170 = -0.55294117647059
171 = -0.55032679738562
172 = -0.54771241830065
173 = -0.54509803921569
174 = -0.54248366013072
175 = -0.53986928104575
176 = -0.53725490196078
177 = -0.53464052287582
178 = -0.53202614379085
179 = -0.52941176470588
180 = -0.52679738562092
181 = -0.52418300653595
182 = -0.52156862745098
183 = -0.51895424836601
184 = -0.51633986928105
185 = -0.51372549019608
186 = -0.51111111111111
187 = -0.50849673202614
188 = -0.50588235294118
189 = -0.50326797385621
190 = -0.50065359477124
191 = -0.49803921568627
192 = -0.49542483660131
193 = -0.49281045751634
194 = -0.49019607843137
195 = -0.48758169934641
196 = -0.48496732026144
197 = -0.48235294117647
198 = -0.4797385620915
199 = -0.47712418300654
200 = -0.47450980392157
201 = -0.4718954248366
202 = -0.46928104575163
203 = -0.46666666666667
204 = -0.4640522875817
205 = -0.46143790849673
206 = -0.45882352941176
207 = -0.4562091503268
208 = -0.45359477124183
209 = -0.45098039215686
210 = -0.4483660130719
211 = -0.44575163398693
212 = -0.44313725490196
213 = -0.44052287581699
214 = -0.43790849673203
215 = -0.43529411764706
216 = -0.43267973856209
217 = -0.43006535947712
218 = -0.42745098039216
219 = -0.42483660130719
220 = -0.42222222222222
221 = -0.41960784313725
222 = -0.41699346405229
223 = -0.41437908496732
224 = -0.41176470588235
225 = -0.40915032679739
226 = -0.40653594771242
227 = -0.40392156862745
228 = -0.40130718954248
229 = -0.39869281045752
230 = -0.39607843137255
231 = -0.39346405228758
232 = -0.39084967320261
233 = -0.38823529411765
234 = -0.38562091503268
235 = -0.38300653594771
236 = -0.38039215686275
237 = -0.37777777777778
238 = -0.37516339869281
239 = -0.37254901960784
240 = -0.36993464052288
241 = -0.36732026143791
242 = -0.36470588235294
243 = -0.36209150326797
244 = -0.35947712418301
245 = -0.35686274509804
246 = -0.35424836601307
247 = -0.3516339869281
248 = -0.34901960784314
249 = -0.34640522875817
250 = -0.3437908496732
251 = -0.34117647058824
252 = -0.33856209150327
253 = -0.3359477124183
254 = -0.33333333333333
255 = -0.33071895424837
256 = -0.3281045751634
257 = -0.32549019607843
258 = -0.32287581699346
259 = -0.3202614379085
260 = -0.31764705882353
261 = -0.31503267973856
262 = -0.31241830065359
263 = -0.30980392156863
264 = -0.30718954248366
265 = -0.30457516339869
266 = -0.30196078431373
267 = -0.29934640522876
268 = -0.29673202614379
269 = -0.29411764705882
270 = -0.29150326797386
271 = -0.28888888888889
272 = -0.28627450980392
273 = -0.28366013071895
274 = -0.28104575163399
275 = -0.27843137254902
276 = -0.27581699346405
277 = -0.27320261437908
278 = -0.27058823529412
279 = -0.26797385620915
280 = -0.26535947712418
281 = -0.26274509803922
282 = -0.26013071895425
283 = -0.25751633986928
284 = -0.25490196078431
285 = -0.25228758169935
286 = -0.24967320261438
287 = -0.24705882352941
288 = -0.24444444444444
289 = -0.24183006535948
290 = -0.23921568627451
291 = -0.23660130718954
292 = -0.23398692810458
293 = -0.23137254901961
294 = -0.22875816993464
295 = -0.22614379084967
296 = -0.22352941176471
297 = -0.22091503267974
298 = -0.21830065359477
299 = -0.2156862745098
300 = -0.21307189542484
301 = -0.21045751633987
302 = -0.2078431372549
303 = -0.20522875816993
304 = -0.20261437908497
305 = -0.2
306 = -0.19738562091503
307 = -0.19477124183007
308 = -0.1921568627451
309 = -0.18954248366013
310 = -0.18692810457516
311 = -0.1843137254902
312 = -0.18169934640523
313 = -0.17908496732026
314 = -0.17647058823529
315 = -0.17385620915033
316 = -0.17124183006536
317 = -0.16862745098039
318 = -0.16601307189542
319 = -0.16339869281046
320 = -0.16078431372549
321 = -0.15816993464052
322 = -0.15555555555556
323 = -0.15294117647059
324 = -0.15032679738562
325 = -0.14771241830065
326 = -0.14509803921569
327 = -0.14248366013072
328 = -0.13986928104575
329 = -0.13725490196078
330 = -0.13464052287582
331 = -0.13202614379085
332 = -0.12941176470588
333 = -0.12679738562092
334 = -0.12418300653595
335 = -0.12156862745098
336 = -0.11895424836601
337 = -0.11633986928105
338 = -0.11372549019608
339 = -0.11111111111111
340 = -0.10849673202614
341 = -0.10588235294118
342 = -0.10326797385621
343 = -0.10065359477124
344 = -0.098039215686274
345 = -0.095424836601307
346 = -0.09281045751634
347 = -0.090196078431373
348 = -0.087581699346405
349 = -0.084967320261438
350 = -0.082352941176471
351 = -0.079738562091503
352 = -0.077124183006536
353 = -0.074509803921569
354 = -0.071895424836601
355 = -0.069281045751634
356 = -0.066666666666667
357 = -0.064052287581699
358 = -0.061437908496732
359 = -0.058823529411765
360 = -0.056209150326797
361 = -0.05359477124183
362 = -0.050980392156863
363 = -0.048366013071895
364 = -0.045751633986928
365 = -0.043137254901961
366 = -0.040522875816993
367 = -0.037908496732026
368 = -0.035294117647059
369 = -0.032679738562091
370 = -0.030065359477124
371 = -0.027450980392157
372 = -0.02483660130719
373 = -0.022222222222222
374 = -0.019607843137255
375 = -0.016993464052288
376 = -0.01437908496732
377 = -0.011764705882353
378 = -0.0091503267973856
379 = -0.0065359477124183
380 = -0.003921568627451
381 = -0.0013071895424837
382 = 0.0013071895424837
383 = 0.003921568627451
384 = 0.0065359477124183
385 = 0.0091503267973856
386 = 0.011764705882353
387 = 0.01437908496732
388 = 0.016993464052288
389 = 0.019607843137255
390 = 0.022222222222222
391 = 0.024836601307189
392 = 0.027450980392157
393 = 0.030065359477124
394 = 0.032679738562092
395 = 0.035294117647059
396 = 0.037908496732026
397 = 0.040522875816994
398 = 0.043137254901961
399 = 0.045751633986928
400 = 0.048366013071895
401 = 0.050980392156863
402 = 0.05359477124183
403 = 0.056209150326797
404 = 0.058823529411765
405 = 0.061437908496732
406 = 0.064052287581699
407 = 0.066666666666667
408 = 0.069281045751634
409 = 0.071895424836601
410 = 0.074509803921569
411 = 0.077124183006536
412 = 0.079738562091503
413 = 0.082352941176471
414 = 0.084967320261438
415 = 0.087581699346405
416 = 0.090196078431372
417 = 0.09281045751634
418 = 0.095424836601307
419 = 0.098039215686275
420 = 0.10065359477124
421 = 0.10326797385621
422 = 0.10588235294118
423 = 0.10849673202614
424 = 0.11111111111111
425 = 0.11372549019608
426 = 0.11633986928105
427 = 0.11895424836601
428 = 0.12156862745098
429 = 0.12418300653595
430 = 0.12679738562092
431 = 0.12941176470588
432 = 0.13202614379085
433 = 0.13464052287582
434 = 0.13725490196078
435 = 0.13986928104575
436 = 0.14248366013072
437 = 0.14509803921569
438 = 0.14771241830065
439 = 0.15032679738562
440 = 0.15294117647059
441 = 0.15555555555556
442 = 0.15816993464052
443 = 0.16078431372549
444 = 0.16339869281046
445 = 0.16601307189542
446 = 0.16862745098039
447 = 0.17124183006536
448 = 0.17385620915033
449 = 0.17647058823529
450 = 0.17908496732026
451 = 0.18169934640523
452 = 0.1843137254902
453 = 0.18692810457516
454 = 0.18954248366013
455 = 0.1921568627451
456 = 0.19477124183007
457 = 0.19738562091503
458 = 0.2
459 = 0.20261437908497
460 = 0.20522875816993
461 = 0.2078431372549
462 = 0.21045751633987
463 = 0.21307189542484
464 = 0.2156862745098
465 = 0.21830065359477
466 = 0.22091503267974
467 = 0.22352941176471
468 = 0.22614379084967
469 = 0.22875816993464
470 = 0.23137254901961
471 = 0.23398692810458
472 = 0.23660130718954
473 = 0.23921568627451
474 = 0.24183006535948
475 = 0.24444444444444
476 = 0.24705882352941
477 = 0.24967320261438
478 = 0.25228758169935
479 = 0.25490196078431
480 = 0.25751633986928
481 = 0.26013071895425
482 = 0.26274509803922
483 = 0.26535947712418
484 = 0.26797385620915
485 = 0.27058823529412
486 = 0.27320261437908
487 = 0.27581699346405
488 = 0.27843137254902
489 = 0.28104575163399
490 = 0.28366013071895
491 = 0.28627450980392
492 = 0.28888888888889
493 = 0.29150326797386
494 = 0.29411764705882
495 = 0.29673202614379
496 = 0.29934640522876
497 = 0.30196078431373
498 = 0.30457516339869
499 = 0.30718954248366
500 = 0.30980392156863
501 = 0.31241830065359
502 = 0.31503267973856
503 = 0.31764705882353
504 = 0.3202614379085
505 = 0.32287581699346
506 = 0.32549019607843
507 = 0.3281045751634
508 = 0.33071895424837
509 = 0.33333333333333
510 = 0.3359477124183
511 = 0.33856209150327
512 = 0.34117647058824
513 = 0.3437908496732
514 = 0.34640522875817
515 = 0.34901960784314
516 = 0.3516339869281
517 = 0.35424836601307
518 = 0.35686274509804
519 = 0.35947712418301
520 = 0.36209150326797
521 = 0.36470588235294
522 = 0.36732026143791
523 = 0.36993464052288
524 = 0.37254901960784
525 = 0.37516339869281
526 = 0.37777777777778
527 = 0.38039215686275
528 = 0.38300653594771
529 = 0.38562091503268
530 = 0.38823529411765
531 = 0.39084967320261
532 = 0.39346405228758
533 = 0.39607843137255
534 = 0.39869281045752
535 = 0.40130718954248
536 = 0.40392156862745
537 = 0.40653594771242
538 = 0.40915032679739
539 = 0.41176470588235
540 = 0.41437908496732
541 = 0.41699346405229
542 = 0.41960784313725
543 = 0.42222222222222
544 = 0.42483660130719
545 = 0.42745098039216
546 = 0.43006535947712
547 = 0.43267973856209
548 = 0.43529411764706
549 = 0.43790849673203
550 = 0.44052287581699
551 = 0.44313725490196
552 = 0.44575163398693
553 = 0.4483660130719
554 = 0.45098039215686
555 = 0.45359477124183
556 = 0.4562091503268
557 = 0.45882352941176
558 = 0.46143790849673
559 = 0.4640522875817
560 = 0.46666666666667
561 = 0.46928104575163
562 = 0.4718954248366
563 = 0.47450980392157
564 = 0.47712418300654
565 = 0.4797385620915
566 = 0.48235294117647
567 = 0.48496732026144
568 = 0.48758169934641
569 = 0.49019607843137
570 = 0.49281045751634
571 = 0.49542483660131
572 = 0.49803921568627
573 = 0.50065359477124
574 = 0.50326797385621
575 = 0.50588235294118
576 = 0.50849673202614
577 = 0.51111111111111
578 = 0.51372549019608
579 = 0.51633986928105
580 = 0.51895424836601
581 = 0.52156862745098
582 = 0.52418300653595
583 = 0.52679738562091
584 = 0.52941176470588
585 = 0.53202614379085
586 = 0.53464052287582
587 = 0.53725490196078
588 = 0.53986928104575
589 = 0.54248366013072
590 = 0.54509803921569
591 = 0.54771241830065
592 = 0.55032679738562
593 = 0.55294117647059
594 = 0.55555555555556
595 = 0.55816993464052
596 = 0.56078431372549
597 = 0.56339869281046
598 = 0.56601307189542
599 = 0.56862745098039
600 = 0.57124183006536
601 = 0.57385620915033
602 = 0.57647058823529
603 = 0.57908496732026
604 = 0.58169934640523
605 = 0.5843137254902
606 = 0.58692810457516
607 = 0.58954248366013
608 = 0.5921568627451
609 = 0.59477124183007
610 = 0.59738562091503
611 = 0.6
612 = 0.60261437908497
613 = 0.60522875816993
614 = 0.6078431372549
615 = 0.61045751633987
616 = 0.61307189542484
617 = 0.6156862745098
618 = 0.61830065359477
619 = 0.62091503267974
620 = 0.62352941176471
621 = 0.62614379084967
622 = 0.62875816993464
623 = 0.63137254901961
624 = 0.63398692810458
625 = 0.63660130718954
626 = 0.63921568627451
627 = 0.64183006535948
628 = 0.64444444444444
629 = 0.64705882352941
630 = 0.64967320261438
631 = 0.65228758169935
632 = 0.65490196078431
633 = 0.65751633986928
634 = 0.66013071895425
635 = 0.66274509803922
636 = 0.66535947712418
637 = 0.66797385620915
638 = 0.67058823529412
639 = 0.67320261437909
640 = 0.67581699346405
641 = 0.67843137254902
642 = 0.68104575163399
643 = 0.68366013071895
644 = 0.68627450980392
645 = 0.68888888888889
646 = 0.69150326797386
647 = 0.69411764705882
648 = 0.69673202614379
649 = 0.69934640522876
650 = 0.70196078431373
651 = 0.70457516339869
652 = 0.70718954248366
653 = 0.70980392156863
654 = 0.71241830065359
655 = 0.71503267973856
656 = 0.71764705882353
657 = 0.7202614379085
658 = 0.72287581699346
659 = 0.72549019607843
660 = 0.7281045751634
661 = 0.73071895424837
662 = 0.73333333333333
663 = 0.7359477124183
664 = 0.73856209150327
665 = 0.74117647058824
666 = 0.7437908496732
667 = 0.74640522875817
668 = 0.74901960784314
669 = 0.7516339869281
670 = 0.75424836601307
671 = 0.75686274509804
672 = 0.75947712418301
673 = 0.76209150326797
674 = 0.76470588235294
675 = 0.76732026143791
676 = 0.76993464052288
677 = 0.77254901960784
678 = 0.77516339869281
679 = 0.77777777777778
680 = 0.78039215686274
681 = 0.78300653594771
682 = 0.78562091503268
683 = 0.78823529411765
684 = 0.79084967320261
685 = 0.79346405228758
686 = 0.79607843137255
687 = 0.79869281045752
688 = 0.80130718954248
689 = 0.80392156862745
690 = 0.80653594771242
691 = 0.80915032679739
692 = 0.81176470588235
693 = 0.81437908496732
694 = 0.81699346405229
695 = 0.81960784313725
696 = 0.82222222222222
697 = 0.82483660130719
698 = 0.82745098039216
699 = 0.83006535947712
700 = 0.83267973856209
701 = 0.83529411764706
702 = 0.83790849673203
703 = 0.84052287581699
704 = 0.84313725490196
705 = 0.84575163398693
706 = 0.8483660130719
707 = 0.85098039215686
708 = 0.85359477124183
709 = 0.8562091503268
710 = 0.85882352941176
711 = 0.86143790849673
712 = 0.8640522875817
713 = 0.86666666666667
714 = 0.86928104575163
715 = 0.8718954248366
716 = 0.87450980392157
717 = 0.87712418300654
718 = 0.8797385620915
719 = 0.88235294117647
720 = 0.88496732026144
721 = 0.88758169934641
722 = 0.89019607843137
723 = 0.89281045751634
724 = 0.89542483660131
725 = 0.89803921568627
726 = 0.90065359477124
727 = 0.90326797385621
728 = 0.90588235294118
729 = 0.90849673202614
730 = 0.91111111111111
731 = 0.91372549019608
732 = 0.91633986928105
733 = 0.91895424836601
734 = 0.92156862745098
735 = 0.92418300653595
736 = 0.92679738562092
737 = 0.92941176470588
738 = 0.93202614379085
739 = 0.93464052287582
740 = 0.93725490196078
741 = 0.93986928104575
742 = 0.94248366013072
743 = 0.94509803921569
744 = 0.94771241830065
745 = 0.95032679738562
746 = 0.95294117647059
747 = 0.95555555555556
748 = 0.95816993464052
749 = 0.96078431372549
750 = 0.96339869281046
751 = 0.96601307189542
752 = 0.96862745098039
753 = 0.97124183006536
754 = 0.97385620915033
755 = 0.97647058823529
756 = 0.97908496732026
757 = 0.98169934640523
758 = 0.9843137254902
759 = 0.98692810457516
760 = 0.98954248366013
761 = 0.9921568627451
762 = 0.99477124183007
763 = 0.99738562091503
764 = 1
765 = 1.002614379085

*/
