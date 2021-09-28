import { mount } from '@vue/test-utils';
import HelloWorld from '../../components/HelloWorld';

describe('HelloWorld.vue', () => {
  it('renders props.msg when passed', () => {
    const msg = 'new message';
    const wrapper = mount(HelloWorld);
    expect(wrapper.text()).toMatch('Hello World');
  });
});
