// @ts-check
import { initSchema } from '@aws-amplify/datastore';
import { schema } from './schema';



const { Event, MemberEvent, Member } = initSchema(schema);

export {
  Event,
  MemberEvent,
  Member
};