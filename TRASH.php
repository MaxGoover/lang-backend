<?php

//PRESENT SIMPLE PASSIVE				    to be + Past Participle
//PAST SIMPLE PASSIVE					    to be + Past Participle
//FUTURE SIMPLE PASSIVE					    will be + Past Participle
//
//PRESENT CONTINUOUS PASSIVE				to be + being + Past Participle
//PAST CONTINUOUS PASSIVE				    to be + being + Past Participle
//
//PRESENT PERFECT PASSIVE VOICE (already, just, yet)  have/has + been + Past Participle
//PAST PERFECT PASSIVE					    had + been + Past Participle
//FUTURE PERFECT PASSIVE (by)				Will + have + been + Past Participle

//'Мне нужно говорить по-английски вовсе без каких-либо ошибок.',

//'I need to speak English without any mistakes.',

//Подскажите, пожалуйста, пытаюсь проверить, вызвался ли метод, который стоит в качестве обработчика онклика баттона.
//
//То есть создал экземпляр этого компонента, нахожу у него кнопку баттон (она одна) и вызываю ее клик. Проверяю вызвалась ли функция, которая стоит как обработчик этому клику. Однако expect фейлится..
//
//    const goNextSpy = jest.spyOn(formStepPersonalData.methods, 'goNext');
//
//    const wrapper = mount(formStepPersonalData, {
//      propsData: {
//    email: 'test@test.ru',
//        birthDate: '01.01.2020',
//        phone: '+79286666666',
//        timerCount: 60,
//      },
//      mocks: {
//    $v,
//      },
//    });
//
//    const buttonNext = wrapper.find('button');
//    buttonNext.trigger('click');
//    expect(goNextSpy).toHaveBeenCalled();